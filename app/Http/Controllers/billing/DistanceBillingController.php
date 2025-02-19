<?php

namespace App\Http\Controllers\billing;

use App\Models\DistanceBilling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistanceBillingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $DistanceBilling = DistanceBilling::where('status', 1)->get();
        return view('billing.distance', ['DistanceBilling' => $DistanceBilling]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistanceBilling  $distanceBilling
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $DistanceBilling = DistanceBilling::where('status', 1)->find($id);
        return view('billing.distance-edit', ['DistanceBilling' => $DistanceBilling]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DistanceBilling  $distanceBilling
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request) {
// проверка введенных данных
        $valid = $request->validate([
            'up-15-km' => 'required|numeric|min:0|not_in:0',
            'up-30-km' => 'required|numeric|min:0|not_in:0',
            'up-60-km' => 'required|numeric|min:0|not_in:0',
            'more-60-km' => 'required|numeric|min:0|not_in:0',
            'more-300-km' => 'required|numeric|min:0|not_in:0',
        ]);

        $DistanceBilling = DistanceBilling::find($id);
// заполнение модели данными из формы
        $DistanceBilling->up_15_km = $request->input('up-15-km');
        $DistanceBilling->up_30_km = $request->input('up-30-km');
        $DistanceBilling->up_60_km = $request->input('up-60-km');
        $DistanceBilling->more_60_km = $request->input('more-60-km');
        $DistanceBilling->more_300_km = $request->input('more-300-km');
// сохранение данных в базе
        $DistanceBilling->save();
// переход к странице списка
        return redirect()->route('billing.distance')->with('success', 'Тариф был изменен.');
    }

}
