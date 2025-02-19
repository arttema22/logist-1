<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Salary;
use App\Http\Filters\SalaryFilter;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

//use App\Http\Controllers\TelegramController;

class SalaryController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric']);
        $filter = app()->make(SalaryFilter::class, ['queryParams' => array_filter($data)]);
        if (Gate::allows('is-driver')) {
            $Salaries = Salary::where('status', 1)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('salary.salary', ['Salaries' => $Salaries]);
        } else {
            $Salaries = Salary::where('status', 1)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            $Users = User::where('role_id', 2)->get();
            return view('salary.salary', ['Salaries' => $Salaries, 'Users' => $Users]);
        }
    }

    public function archive(Request $request)
    {
        $data = $request->validate(['driver-id' => 'numeric']);
        $filter = app()->make(SalaryFilter::class, ['queryParams' => array_filter($data)]);
        if (Gate::allows('is-driver')) {
            $Salaries = Salary::where('status', 0)->where('driver_id', Auth::user()->id)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            return view('salary.archive', ['Salaries' => $Salaries]);
        } else {
            $Salaries = Salary::where('status', 0)->filter($filter)->orderByDesc('date')->simplePaginate(config('app.pagination_count'));
            $Users = User::where('role_id', 2)->get();
            return view('salary.archive', ['Salaries' => $Salaries, 'Users' => $Users]);
        }
    }

    public function create()
    {
        $Users = User::where('role_id', 2)->get();
        return view('salary.create', ['Users' => $Users]);
    }

    public function store(Request $request)
    {
        // проверка введенных данных
        $valid = $request->validate([
            'date-salary' => 'required',
            'salary' => 'required',
        ]);
        // создание модели данных
        $Salary = new Salary();
        // заполнение модели данными из формы
        $Salary->owner_id = Auth::user()->id;
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            $Salary->driver_id = Auth::user()->id;
        } else {
            $Salary->driver_id = $request->input('driver-id');
        }
        $Salary->date = $request->input('date-salary');
        $Salary->salary = $request->input('salary');
        $Salary->comment = $request->input('comment');
        // сохранение данных в базе
        $Salary->save();
        //$Telegram = new TelegramController();
        //$Telegram->sendMessage('Произведена выплата водителю.');
        //$Telegram->sendContact();
        // переход к странице списка
        return redirect()->route('salary.list')->with('success', 'Произведена выплата водителю.');
    }

    public function edit($id)
    {
        $Salary = Salary::find($id);
        return view('salary.edit', ['Salary' => $Salary]);
    }

    public function update($id, Request $request)
    {
        // проверка введенных данных
        $valid = $request->validate([
            'date-salary' => 'required',
            'salary' => 'required',
        ]);
        $Salary = Salary::find($id);
        // заполнение модели данными из формы
        $Salary->date = $request->input('date-salary');
        $Salary->salary = $request->input('salary');
        $Salary->comment = $request->input('comment');
        // сохранение данных в базе
        $Salary->save();
        // переход к странице списка
        return redirect()->route('salary.list');
    }

    public function destroy($id)
    {
        Salary::find($id)->delete();
        return redirect()->route('salary.list')->with('warning', 'Запись о выплате была удалена');
    }
}
