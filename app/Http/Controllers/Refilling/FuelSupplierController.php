<?php

namespace App\Http\Controllers\Refilling;

use App\Models\User;
use App\Models\Refilling;
use Illuminate\Http\Request;
use App\Models\DirPetrolStations;
use App\Http\Filters\PetrolFilter;
use App\Http\Controllers\Controller;
use App\Models\Refilling\FuelSupplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FuelSupplierController extends Controller
{
    public function index(Request $request)
    {
        $FuelSuppliers = FuelSupplier::all();
        return view('refilling.fuelsupplier', ['FuelSuppliers' => $FuelSuppliers]);
    }
}
