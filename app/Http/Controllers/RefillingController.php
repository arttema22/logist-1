<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refilling;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DirPetrolStations;
//use App\Http\Controllers\TelegramController;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\RefillingExport;
use App\Http\Filters\PetrolFilter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RefillingController extends Controller
{

    // список актуальных заправок
    public function index(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric', 'petrol-id' => 'numeric']);
        $filter = app()->make(PetrolFilter::class, ['queryParams' => array_filter($data)]);
        if (Gate::allows('is-driver')) {
            $Refillings = Refilling::where('status', 1)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('refilling.refilling', ['Refillings' => $Refillings]);
        } else {
            $Refillings = Refilling::where('status', 1)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            $Users = User::where('role_id', 2)->get();
            $PerolSt = DirPetrolStations::all();
            return view('refilling.refilling', ['Refillings' => $Refillings, 'Users' => $Users, 'PerolSt' => $PerolSt]);
        }
    }
    // список архивных заправок
    public function archive(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric', 'petrol-id' => 'numeric']);
        $filter = app()->make(PetrolFilter::class, ['queryParams' => array_filter($data)]);
        if (Gate::allows('is-driver')) {
            $Refillings = Refilling::where('status', 0)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('refilling.archive', ['Refillings' => $Refillings]);
        } else {
            $Refillings = Refilling::where('status', 0)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            $Users = User::where('role_id', 2)->get();
            $PerolSt = DirPetrolStations::all();
            return view('refilling.archive', ['Refillings' => $Refillings, 'Users' => $Users, 'PerolSt' => $PerolSt]);
        }
    }

    // новая заправка
    public function create()
    {
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $PetrolStations = DirPetrolStations::all();
            return view('refilling.create', ['PetrolStations' => $PetrolStations]);
        } else {
            $Users = User::where('role_id', 2)->get();
            $PetrolStations = DirPetrolStations::all();
            return view('refilling.create', ['Users' => $Users, 'PetrolStations' => $PetrolStations]);
        }
    }

    // новая заправка
    public function store(Request $request)
    {
        // проверка введенных данных
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $valid = $request->validate([
                'petrol-stations-id' => 'required|numeric|min:0|not_in:0',
                'date-car-refueling' => 'required',
                'num-liters-car-refueling' => 'required',
                'price-car-refueling' => 'required',
            ]);
        } else {
            $valid = $request->validate([
                'driver-id' => 'required|numeric|min:0|not_in:0',
                'petrol-stations-id' => 'required|numeric|min:0|not_in:0',
                'date-car-refueling' => 'required',
                'num-liters-car-refueling' => 'required',
                'price-car-refueling' => 'required',
            ]);
        }
        // создание модели данных
        $Refilling = new Refilling();
        // заполнение модели данными из формы
        $Refilling->owner_id = Auth::user()->id;
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $Refilling->driver_id = Auth::user()->id;
        } else {
            $Refilling->driver_id = $request->input('driver-id');
        }
        $Refilling->petrol_stations_id = $request->input('petrol-stations-id');
        $Refilling->date = $request->input('date-car-refueling');
        $Refilling->num_liters_car_refueling = $request->input('num-liters-car-refueling');
        $Refilling->price_car_refueling = $request->input('price-car-refueling');
        $Refilling->cost_car_refueling = $request->input('num-liters-car-refueling') * $request->input('price-car-refueling');
        // сохранение данных в базе
        $Refilling->save();
        //$Telegram = new TelegramController();
        //$Telegram->sendMessage('Произведена запись о заправке автомобиля.');
        //$Telegram->sendContact();
        // переход к странице списка
        return redirect()->route('refilling.list')->with('success', 'Создана новая заправка.');
    }

    // изменение заправки
    public function edit($id)
    {
        $Refilling = Refilling::find($id);
        $PetrolStations = DirPetrolStations::all();
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            return view('refilling.edit', ['Refilling' => $Refilling, 'PetrolStations' => $PetrolStations]);
        } else {
            $Users = User::all();
            return view('refilling.edit', ['Refilling' => $Refilling, 'Users' => $Users, 'PetrolStations' => $PetrolStations]);
        }
    }

    // изменение заправки
    public function update($id, Request $request)
    {


        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $valid = $request->validate([
                'petrol-stations-id' => 'required|numeric|min:0|not_in:0',
                'date-car-refueling' => 'required',
                'num-liters-car-refueling' => 'required',
                'price-car-refueling' => 'required',
            ]);
        } else {
            $valid = $request->validate([
                'driver-id' => 'required|numeric|min:0|not_in:0',
                'petrol-stations-id' => 'required|numeric|min:0|not_in:0',
                'date-car-refueling' => 'required',
                'num-liters-car-refueling' => 'required',
                'price-car-refueling' => 'required',
            ]);
        }

        $Refilling = Refilling::find($id);
        // заполнение модели данными из формы
        $Refilling->owner_id = Auth::user()->id;
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $Refilling->driver_id = Auth::user()->id;
        } else {
            $Refilling->driver_id = $request->input('driver-id');
        }
        $Refilling->petrol_stations_id = $request->input('petrol-stations-id');
        $Refilling->date = $request->input('date-car-refueling');
        $Refilling->num_liters_car_refueling = $request->input('num-liters-car-refueling');
        $Refilling->price_car_refueling = $request->input('price-car-refueling');
        $Refilling->cost_car_refueling = $request->input('num-liters-car-refueling') * $request->input('price-car-refueling');
        // сохранение данных в базе
        $Refilling->save();
        // переход к странице списка
        return redirect()->route('refilling.list')->with('success', 'Запись о заправке была изменена.');
    }

    // удаление заправки
    public function destroy($id)
    {
        Refilling::find($id)->delete();
        // переход к странице списка
        return redirect()->route('refilling.list')->with('warning', 'Запись о заправке была удалена');
    }

    public function statistics(Request $request)
    {
        // $data = $request->validate(['driver-id' => 'numeric']);
        // $filter = app()->make(PetrolFilter::class, ['queryParams' => array_filter($data)]);
        // $Refillings = Refilling::filter($filter)->simplePaginate(config('app.pagination_count'));
        // $Users = User::where('role_id', 2)->get();

        $record = Refilling::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(date) as day_name"), DB::raw("DAY(date) as day"))
            //->where('date', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $data = [];

        foreach ($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }

        $data['chart_data'] = json_encode($data);
        dd($data);
        return view('refilling.statistics', $data);
    }
}
