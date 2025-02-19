<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefillingsTable extends Migration
{

    public function up()
    {
        Schema::create('refillings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->BigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->BigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->BigInteger('petrol_stations_id')->unsigned();
            $table->foreign('petrol_stations_id')->references('id')->on('dir_petrol_stations');
            $table->integer('num_liters_car_refueling');
            $table->float('price_car_refueling', 8, 2);
            $table->float('cost_car_refueling', 8, 2);
            $table->BigInteger('profit_id')->unsigned()->default(0);
            $table->text('comment')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('refillings');
    }
}
