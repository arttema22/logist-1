<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Refilling;
use App\Models\Routes;
use App\Models\Salary;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        if (Gate::allows('is-driver')) {
            $RoutesAll = Routes::where('driver_id', Auth::user()->id)->count();
            $RoutesActive = Routes::where('driver_id', Auth::user()->id)->where('status', 1)->count();
            $RefillingsAll = Refilling::where('driver_id', Auth::user()->id)->count();
            $RefillingsActive = Refilling::where('driver_id', Auth::user()->id)->where('status', 1)->count();
            $SalaryAll = Salary::where('driver_id', Auth::user()->id)->count();
            $SalaryActive = Salary::where('driver_id', Auth::user()->id)->where('status', 1)->count();
        } else {
            $RoutesAll = Routes::count();
            $RoutesActive = Routes::where('status', 1)->count();
            $RefillingsAll = Refilling::count();
            $RefillingsActive = Refilling::where('status', 1)->count();
            $SalaryAll = Salary::count();
            $SalaryActive = Salary::where('status', 1)->count();
        }
        return view('home', [
            'RoutesAll' => $RoutesAll, 'RoutesActive' => $RoutesActive,
            'RefillingsAll' => $RefillingsAll, 'RefillingsActive' => $RefillingsActive,
            'SalaryAll' => $SalaryAll, 'SalaryActive' => $SalaryActive
        ]);
    }
}
