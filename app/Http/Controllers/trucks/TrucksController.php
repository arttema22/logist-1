<?php

namespace App\Http\Controllers\trucks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trucks;
use App\Models\User;
use App\Models\TypeTrucks;

class TrucksController extends Controller {

    public function index() {
        $Trucks = new Trucks();
        return view('trucks.trucks', ['Trucks' => $Trucks->all()]);
    }

    public function new() {
        $users = User::all();
        $typetrucks = TypeTrucks::all();
        return view('trucks.trucks-new', ['users' => $users, 'typetrucks' => $typetrucks]);
    }

    public function new_save(Request $request) {
        // проверка введенных данных
        $valid = $request->validate([
            'users-id' => 'required|numeric|min:0)',
            'type-trucks-id' => 'required|numeric|min:0',
            'truck-number' => 'required',
            'truck-owner' => 'required',
        ]);
        // создание модели данных
        $Trucks = new Trucks();
        // заполнение модели данными из формы
        $Trucks->users_id = $request->input('users-id');
        $Trucks->type_trucks_id = $request->input('type-trucks-id');
        $Trucks->truck_number = $request->input('truck-number');
        $Trucks->truck_owner = $request->input('truck-owner');
        // сохранение данных в базе
        $Trucks->save();
        // переход к странице списка
        return redirect()->route('trucks.list')->with('success', 'Создана новая запись');
    }

    public function update($id) {
        $TypeTrucks = new TypeTrucks();
        return view('setup.type-trucks-update', ['TypeTrucks' => $TypeTrucks->find($id)]);
    }

    public function update_save($id, Request $request) {
        // проверка введенных данных
        $valid = $request->validate([
            'title' => 'required'
        ]);
        $TypeTrucks = TypeTrucks::find($id);
        // заполнение модели данными из формы
        $TypeTrucks->title = $request->input('title');
        // сохранение данных в базе
        $TypeTrucks->save();
        return redirect()->route('setup.type-trucks')->with('success', 'Запись была изменена');
    }

    public function delete($id) {
        TypeTrucks::find($id)->delete();
        return redirect()->route('setup.type-trucks')->with('warning', 'Запись была удалена');
    }

}
