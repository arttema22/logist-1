<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DirTypeTrucks;
use App\Models\DirOwnerTrucks;
use App\Models\DirPlaceWork;
use App\Models\DirCargo;
use App\Models\DirAddress;
use App\Models\DirPetrolStations;
use App\Models\DistanceBilling;
use App\Models\DirPayers;
use App\Models\DirServices;

class DirectoryController extends Controller
{

    public function type_trucks()
    {
        $TypeTrucks = new DirTypeTrucks();
        return view('directory.type-trucks', ['TypeTrucks' => $TypeTrucks->all()]);
    }

    public function type_trucks_new()
    {
        return view('directory.type-trucks-new');
    }

    public function type_trucks_new_save(Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_type_trucks,title', 'is-service' => 'boolean']);
        $TypeTrucks = new DirTypeTrucks();
        $TypeTrucks->title = $request->input('title');
        $TypeTrucks->is_service = ($request->has('is-service')) ? 1 : 0;
        $TypeTrucks->save();
        $DistanceBilling = new DistanceBilling();
        $DistanceBilling->type_truck_id = $TypeTrucks->id;
        $DistanceBilling->save();
        return redirect()->route('directory.type-trucks')->with('success', 'Создан новый тип. Не забудьте заполнить тарифы к новому типу.');
    }

    public function type_trucks_update($id)
    {
        $TypeTrucks = new DirTypeTrucks();
        return view('directory.type-trucks-update', ['TypeTrucks' => $TypeTrucks->find($id)]);
    }

    public function type_trucks_update_save($id, Request $request)
    {
        $valid = $request->validate(['title' => 'required', 'is-service' => 'boolean']);
        $TypeTrucks = DirTypeTrucks::find($id);
        $TypeTrucks->title = $request->input('title');
        $TypeTrucks->is_service = ($request->has('is-service')) ? 1 : 0;
        $TypeTrucks->save();
        return redirect()->route('directory.type-trucks')->with('success', 'Запись была изменена');
    }

    public function type_trucks_delete($id)
    {
        $TypeTrucks = DirTypeTrucks::find($id);
        $TypeTrucks->status = 0;
        $TypeTrucks->save();
        $DistanceBilling = DistanceBilling::find($TypeTrucks->distanceBilling->id);
        $DistanceBilling->status = 0;
        $DistanceBilling->save();
        return redirect()->route('directory.type-trucks')->with('warning', 'Запись была удалена');
    }

    public function type_trucks_recover($id)
    {
        $TypeTrucks = DirTypeTrucks::find($id);
        $TypeTrucks->status = 1;
        $TypeTrucks->save();
        $DistanceBilling = DistanceBilling::find($TypeTrucks->distanceBilling->id);
        $DistanceBilling->status = 1;
        $DistanceBilling->save();
        return redirect()->route('directory.type-trucks')->with('success', 'Запись была восстановлена');
    }

    public function cargo()
    {
        $Cargos = new DirCargo();
        return view('directory.cargo', ['Cargos' => $Cargos->all()]);
    }

    public function cargo_new()
    {
        return view('directory.cargo-new');
    }

    public function cargo_new_save(Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_cargos,title']);
        $Cargo = new DirCargo();
        $Cargo->title = $request->input('title');
        $Cargo->save();
        return redirect()->route('directory.cargo')->with('success', 'Создана новая запись');
    }

    public function cargo_update($id)
    {
        $Cargo = new DirCargo();
        return view('directory.cargo-update', ['Cargo' => $Cargo->find($id)]);
    }

    public function cargo_update_save($id, Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_cargos,title']);
        $Cargo = DirCargo::find($id);
        $Cargo->title = $request->input('title');
        $Cargo->save();
        return redirect()->route('directory.cargo')->with('success', 'Запись была изменена');
    }

    public function cargo_delete($id)
    {
        DirCargo::destroy($id);
        return redirect()->route('directory.cargo')->with('warning', 'Запись была удалена');
    }

    public function cargo_recover($id)
    {
        $Cargo = DirCargo::find($id);
        $Cargo->status = 1;
        $Cargo->save();
        return redirect()->route('directory.cargo')->with('success', 'Запись была восстановлена');
    }

    public function petrol_stations()
    {
        $PetStations = new DirPetrolStations();
        return view('directory.petrol-stations', ['PetStations' => $PetStations->all()]);
    }

    public function petrol_stations_new()
    {
        return view('directory.petrol-stations-new');
    }

    public function petrol_stations_new_save(Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_petrol_stations,title']);
        $PetStations = new DirPetrolStations();
        $PetStations->title = $request->input('title');
        $PetStations->save();
        return redirect()->route('directory.petrol-stations')->with('success', 'Создана новая запись');
    }

    public function petrol_stations_update($id)
    {
        $PetStations = new DirPetrolStations();
        return view('directory.petrol-stations-update', ['PetStations' => $PetStations->find($id)]);
    }

    public function petrol_stations_update_save($id, Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_petrol_stations,title']);
        $PetStations = DirPetrolStations::find($id);
        $PetStations->title = $request->input('title');
        $PetStations->save();
        return redirect()->route('directory.petrol-stations')->with('success', 'Запись была изменена');
    }

    public function petrol_stations_delete($id)
    {
        $PetStations = DirPetrolStations::find($id);
        $PetStations->status = 0;
        $PetStations->save();
        return redirect()->route('directory.petrol-stations')->with('warning', 'Запись была удалена');
    }

    public function petrol_stations_recover($id)
    {
        $PetStations = DirPetrolStations::find($id);
        $PetStations->status = 1;
        $PetStations->save();
        return redirect()->route('directory.petrol-stations')->with('success', 'Запись была восстановлена');
    }

    public function payers()
    {
        $Payers = new DirPayers();
        return view('directory.payers', ['Payers' => $Payers->all()]);
    }

    public function payers_new()
    {
        return view('directory.payers-new');
    }

    public function payers_new_save(Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_payers,title']);
        $Payers = new DirPayers();
        $Payers->title = $request->input('title');
        $Payers->save();
        return redirect()->route('directory.payers')->with('success', 'Создана новая запись');
    }

    public function payers_update($id)
    {
        $Payers = new DirPayers();
        return view('directory.payers-update', ['Payers' => $Payers->find($id)]);
    }

    public function payers_update_save($id, Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:dir_payers,title']);
        $Payers = DirPayers::find($id);
        $Payers->title = $request->input('title');
        $Payers->save();
        return redirect()->route('directory.payers')->with('success', 'Запись была изменена');
    }

    public function payers_delete($id)
    {
        $Payers = DirPayers::find($id);
        $Payers->status = 0;
        $Payers->save();
        return redirect()->route('directory.payers')->with('warning', 'Запись была удалена');
    }

    public function payers_recover($id)
    {
        $Payers = DirPayers::find($id);
        $Payers->status = 1;
        $Payers->save();
        return redirect()->route('directory.payers')->with('success', 'Запись была восстановлена');
    }

    public function services()
    {
        $Services = new DirServices();
        return view('directory.services', ['Services' => $Services->all()]);
    }

    public function services_new()
    {
        return view('directory.services-new');
    }

    public function services_new_save(Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|unique:dir_services,title',
            'price' => 'required|numeric|min:0|not_in:0'
        ]);
        $Services = new DirServices();
        $Services->title = $request->input('title');
        $Services->price = $request->input('price');
        $Services->save();
        return redirect()->route('directory.services')->with('success', 'Создана новая услуга');
    }

    public function services_update($id)
    {
        $Services = new DirServices();
        return view('directory.services-update', ['Services' => $Services->find($id)]);
    }

    public function services_update_save($id, Request $request)
    {
        $valid = $request->validate([
            'title' => 'required|unique:dir_services,title',
            'price' => 'required|numeric|min:0|not_in:0'
        ]);
        $Services = DirServices::find($id);
        $Services->title = $request->input('title');
        $Services->price = $request->input('price');
        $Services->save();
        return redirect()->route('directory.services')->with('success', 'Запись была изменена');
    }

    public function services_delete($id)
    {
        $Services = DirServices::find($id);
        $Services->status = 0;
        $Services->save();
        return redirect()->route('directory.services')->with('warning', 'Запись была удалена');
    }

    public function services_recover($id)
    {
        $Services = DirServices::find($id);
        $Services->status = 1;
        $Services->save();
        return redirect()->route('directory.services')->with('success', 'Запись была восстановлена');
    }
}
