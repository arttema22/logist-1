<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Revise;
use App\Models\ReviseData;
use App\Models\Profits;
use \App\Models\ProfitsData;

class ReviseController extends Controller {

    // список сверок
    public function list() {
        $Users = User::where('role_id', 2)->get();
        return view('revise.revise', ['Users' => $Users]);
    }

    public function store() {
        $Revise = new Revise;
        $Revise->owner_id = Auth::user()->id;
        $last = Revise::latest()->first();
        If ($last == null) {
            $Revise->date_start = now();
        } else {
            $Revise->date_start = $last->date_end;
        }
        $Revise->date_end = now();
        $Revise->save();

        $Users = User::where('role_id', 2)->get();
        if (count($Users)) {
            foreach ($Users as $User) {
                $ReviseData = new ReviseData;
                $ReviseData->revise_id = $Revise->id;
                $ReviseData->driver_id = $User->id;
                $last = ReviseData::where('driver_id', $User->id)->latest()->first();
                If ($last == null) {
                    $ReviseData->balance_start = 0;
                } else {
                    $ReviseData->balance_start = $last->balance_end;
                }
                $Profits = ProfitsData::where('status', 1)->where('driver_id', $User->id)->get();
                if (count($Profits)) {
                    $sum_total = 0;
                    $paid = 0;
                    foreach ($Profits as $Profit) {
                        $sum_total = $sum_total + $Profit->sum_total;
                        $paid = $paid + $Profit->sum_salary;
                    }
                    $ReviseData->added = $sum_total;
                    $ReviseData->paid = $paid;
                } else {
                    $ReviseData->added = 0;
                    $ReviseData->paid = 0;
                }
                $ReviseData->balance_end = $ReviseData->balance_start + $ReviseData->added - $ReviseData->paid;
                $ReviseData->save();
            }
            ProfitsData::where('status', 1)->update(['status' => 0]);
        } else {
            return redirect()->route('revise.revise')->with('danger', 'Рассчет невозможен. В системе нет водителей.');
        }
        return redirect()->route('revise.revise')->with('success', 'Рассчет произведен.');
    }

}
