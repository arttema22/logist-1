<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Routes;
use App\Models\DirCargo;
use App\Models\Services;
use App\Models\DirPayers;
use App\Models\DirDistance;
use App\Models\DirServices;
use App\Models\DirTypeTruck;
use App\Models\RouteBilling;
use Illuminate\Http\Request;
use App\Models\DirTypeTrucks;
use App\Models\DistanceBilling;
use App\Http\Filters\RoutesFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

//use App\Http\Controllers\TelegramController;

class RoutesController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric', 'type-truck-id' => 'numeric']);
        $filter = app()->make(RoutesFilter::class, ['queryParams' => array_filter($data)]);
        $Services = DirServices::all();
        $Payers = DirPayers::all();
        $TypeTrucks = DirTypeTrucks::all();
        $Cargo = DirCargo::all();
        if (Gate::allows('is-driver')) {
            $Routes = Routes::where('status', 1)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('routes.routes', ['Routes' => $Routes, 'Services' => $Services, 'Payers' => $Payers, 'TypeTrucks' => $TypeTrucks, 'Cargo' => $Cargo]);
        } else {
            $Users = User::where('role_id', 2)->get();
            $Routes = Routes::where('status', 1)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('routes.routes', ['Routes' => $Routes, 'Users' => $Users, 'Services' => $Services, 'Payers' => $Payers, 'TypeTrucks' => $TypeTrucks, 'Cargo' => $Cargo]);
        }
    }

    public function archive(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric', 'type-truck-id' => 'numeric']);
        $filter = app()->make(RoutesFilter::class, ['queryParams' => array_filter($data)]);
        if (Gate::allows('is-driver')) {
            $Routes = Routes::where('status', 0)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('routes.archive', ['Routes' => $Routes]);
        } else {
            $Users = User::where('role_id', 2)->get();
            $TypeTrucks = DirTypeTrucks::all();
            $Routes = Routes::where('status', 0)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('routes.archive', ['Routes' => $Routes, 'Users' => $Users, 'TypeTrucks' => $TypeTrucks]);
        }
    }

    public function create()
    {
        $TypeTrucks = DirTypeTrucks::all();
        $Cargo = DirCargo::all();
        $Payers = DirPayers::all();
        $RoutesBilling = RouteBilling::all();
        $Services = DirServices::all();
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            return view('routes.create', ['TypeTrucks' => $TypeTrucks, 'Cargo' => $Cargo, 'Payers' => $Payers, 'RoutesBilling' => $RoutesBilling, 'Services' => $Services]);
        } else {
            $Users = User::where('role_id', 2)->get();
            return view('routes.create', ['Users' => $Users, 'TypeTrucks' => $TypeTrucks, 'Cargo' => $Cargo, 'Payers' => $Payers, 'RoutesBilling' => $RoutesBilling, 'Services' => $Services]);
        }
    }

    public function store(Request $request)
    {
        // проверка введенных данных
        $valid = $request->validate([
            'date-route' => 'required|date',
            'type-truck' => 'required|numeric|not_in:0',
            'cargo' => 'required|numeric|min:0|not_in:0',
            'number-trips' => 'required|numeric',
        ]);
        if (Gate::denies('is-driver')) {
            $valid = $request->validate([
                'driver-id' => 'required|numeric|min:0|not_in:0',
            ]);
        }

        // проверка на нового плательщика
        if ($request->input('collapse-new-payer')) {
            $valid = $request->validate(['new-payer' => 'required|unique:dir_payers,title']);
            $Payer = new DirPayers();
            $Payer->title = $request->input('new-payer');
            $Payer->save();
            $payer_id = $Payer->id;
        } else {
            $valid = $request->validate(['payer' => 'required|numeric|min:0|not_in:0']);
            $payer_id = $request->input('payer');
        }
        // проверка на новый маршрут
        if ($request->input('collapse-new-route')) {
            $valid = $request->validate([
                'address-loading' => 'required',
                'address-unloading' => 'required',
                'route-length' => 'required',
            ]);
            // Записываем новый маршрут
            $RouteBill = new RouteBilling();
            $RouteBill->start = $request->input('address-loading');
            $RouteBill->finish = $request->input('address-unloading');
            $RouteBill->length = $request->input('route-length');
            $RouteBill->save();
            $route_id = $RouteBill->id;
        } else {
            $valid = $request->validate(['route-billing' => 'required|numeric|min:0|not_in:0']);
            $route_id = $request->input('route-billing');
        }
        // создание модели данных
        $Route = new Routes();
        // заполнение модели данными из формы
        $Route->owner_id = Auth::user()->id;
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $Route->driver_id = Auth::user()->id;
        } else {
            $Route->driver_id = $request->input('driver-id');
        }
        /* возможно получение отрицательного значения
         * перевод отрицательного значения в положительное
         */
        $val_type_truck = $request->input('type-truck');
        if ($val_type_truck < 0) {
            $val_type_truck = gmp_strval(gmp_neg($val_type_truck));
        }
        $Route->dir_type_trucks_id = $val_type_truck;
        $Route->cargo_id = $request->input('cargo');

        $Payer_data = DirPayers::find($payer_id);
        $Route->payer_id = $Payer_data->id;

        $Route_bill = RouteBilling::find($route_id);
        $Route->address_loading = $Route_bill->start;
        $Route->address_unloading = $Route_bill->finish;
        if ($Route_bill->is_static == 1) {
            $Route->route_length = 0;
        } else {
            $Route->route_length = $Route_bill->length;
        }
        $Route->date = $request->input('date-route');
        $Route->number_trips = $request->input('number-trips');

        // расчет цены маршрута СТАРЫЙ
        // if ($Route_bill->is_static == 1) {
        //     $Route->price_route = $Route_bill->price;
        // } else {
        //     $Distance = DistanceBilling::find($Route->dir_type_trucks_id);
        //     if ($Route->route_length >= 300) {
        //         $Route->price_route = $Distance->more_300_km * $Route->route_length; //стоимость за 1 км * расстояние
        //     } elseif ($Route->route_length >= 60) {
        //         $Route->price_route = $Distance->more_60_km * $Route->route_length; //стоимость за 1 км * расстояние
        //     } elseif ($Route->route_length <= 15) {
        //         $Route->price_route = $Distance->up_15_km; // стоимость всего маршрута
        //     } elseif ($Route->route_length <= 30) {
        //         $Route->price_route = $Distance->up_30_km; // стоимость всего маршрута
        //     } else {
        //         //if ($Route->dir_type_trucks_id == 2) {
        //         //    $Route->price_route = $Distance->up_60_km * $Route->route_length; //стоимость за 1 км * расстояние
        //         //} else {
        //         $Route->price_route = $Distance->up_60_km; // стоимость всего маршрута
        //         //}
        //     }
        // }

        // расчет цены маршрута по НОВОЙ схеме
        if (
            $Route_bill->is_static == 1
        ) {
            $Route->price_route = $Route_bill->price;
        } else {
            $length = $Route_bill->length;
            $tariff = DirTypeTruck::find($val_type_truck)->tariffs()->where('start', '<=', $length)->where('end', '>=', $length)->first();
            $tariff->type_calculation ? $Route->price_route = $tariff->price * $length
                : $Route->price_route = $tariff->price;
        }

        $Route->price_route = $Route->price_route * $Route->number_trips;

        if ($request->filled('unexpected-expenses')) {
            $Route->unexpected_expenses = $request->input('unexpected-expenses');
        }

        // расчет суммы маршрута
        if ($request->input('type-truck') < 0) {
            $Route->summ_route = ($Route->price_route / 100) * 20 + $Route->unexpected_expenses;
        } else {
            $Route->summ_route = $Route->price_route / 2 + $Route->unexpected_expenses;
        }

        $Route->comment = $request->input('comment');
        // сохранение данных в базе
        $Route->save();

        /* Запись дополнительных услуг */
        $service_id = $request->service_id;
        $number_operations = $request->number_operations;
        $service_comment = $request->service_comment;

        if (!empty($service_id)) {
            for ($i = 0; $i < count($service_id); $i++) {
                if ($service_id[$i] > 0) {
                    $Service = new Services();
                    $Service->date = $request->input('date-route');
                    if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
                        $Service->driver_id = Auth::user()->id;
                    } else {
                        $Service->driver_id = $request->input('driver-id');
                    }
                    $Service->route_id = $Route->id;
                    $Service->service_id = $service_id[$i];
                    $Service->price = $Service->service->price;
                    $Service->number_operations = $number_operations[$i];
                    $Service->sum = $Service->price * $Service->number_operations;
                    $Service->comment = $service_comment[$i];
                    $Service->save();
                }
            }
        }

        // Оповещение в Телеграм
        //$Telegram = new TelegramController();
        //$Telegram->sendMessage('Создан новый маршрут.');
        //$Telegram->sendContact();
        // переход к странице списка
        return redirect()->route('routes.list')->with('success', 'Новый маршрут успешно сохранен.');
    }

    public function edit($id)
    {
        $Route = Routes::find($id);
        $Users = User::where('role_id', 2)->get();
        $TypeTrucks = DirTypeTrucks::all();
        $Cargo = DirCargo::all();
        $Payers = DirPayers::all();
        $Services = DirServices::all();
        return view('routes.edit', ['Users' => $Users, 'TypeTrucks' => $TypeTrucks, 'Cargo' => $Cargo, 'Payers' => $Payers, 'Services' => $Services, 'Route' => $Route]);
    }

    public function update($id, Request $request)
    {
        // проверка введенных данных
        $valid = $request->validate([
            'driver-id' => 'required|numeric|min:0|not_in:0',
            'type-truck' => 'required|numeric|not_in:0',
            'cargo' => 'required|numeric|min:0|not_in:0',
            'payer' => 'required|numeric|min:0|not_in:0',
            'address-loading' => 'required',
            'address-unloading' => 'required',
            'route-length' => 'required|numeric',
            'price-route' => 'required|numeric',
            'date-route' => 'required|date',
            'number-trips' => 'required|numeric',
        ]);
        $Route = Routes::find($id);
        // заполнение модели данными из формы
        $Route->driver_id = $request->input('driver-id');
        /* возможно получение отрицательного значения
         * перевод отрицательного значения в положительное
         */
        $val = $request->input('type-truck');
        if ($val < 0) {
            $val = gmp_strval(gmp_neg($val));
        }
        $Route->dir_type_trucks_id = $val;
        $Route->cargo_id = $request->input('cargo');
        $Route->payer_id = $request->input('payer');
        $Route->address_loading = $request->input('address-loading');
        $Route->address_unloading = $request->input('address-unloading');
        $Route->date = $request->input('date-route');
        $Route->route_length = $request->input('route-length');
        $Route->price_route = $request->input('price-route');
        $Route->number_trips = $request->input('number-trips');
        if ($request->filled('unexpected-expenses')) {
            $Route->unexpected_expenses = $request->input('unexpected-expenses');
        }
        $Route->summ_route = ($Route->price_route * $Route->number_trips) / 2 + $Route->unexpected_expenses;
        $Route->comment = $request->input('comment');

        // сохранение данных в базе
        $Route->save();
        // переход к странице списка
        return redirect()->route('routes.list')->with('success', 'Маршрут успешно изменен.');
    }

    public function destroy($id)
    {
        Routes::find($id)->delete();
        // переход к странице списка
        return redirect()->route('routes.list')->with('warning', 'Маршрут был удален');
    }

    public function service_store($route_id, Request $request)
    {
        $valid = $request->validate([
            'service-id' => 'required',
            'number-operations' => 'required|numeric|min:0|not_in:0',
        ]);
        $Service = new Services();
        $Service->route_id = $route_id;
        $Service->service_id = $request->input('service-id');
        $Service->price = $Service->service->price;
        $Service->number_operations = $request->input('number-operations');
        $Service->sum = $Service->price * $Service->number_operations;
        $Service->comment = $request->input('service-comment');
        $Service->save();
        return redirect()->route('routes.list');
    }

    public function service_update($id, Request $request)
    {
        $Service = Services::find($id);
        $Service->service_id = $request->input('service-' . $id);
        $Service->price = $request->input('price-' . $id);
        $Service->number_operations = $request->input('number-oper-' . $id);
        $Service->sum = $Service->price * $Service->number_operations;
        $Service->comment = $request->input('comment-' . $id);
        $Service->save();
        return redirect()->route('routes.list');
    }

    public function service_destroy($id)
    {
        Services::find($id)->delete();
        // переход к странице списка
        return redirect()->route('routes.list');
    }
}
