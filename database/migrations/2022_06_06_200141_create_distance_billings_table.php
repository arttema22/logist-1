<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistanceBillingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distance_billings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BigInteger('type_truck_id')->unsigned();
            $table->foreign('type_truck_id')->references('id')->on('dir_type_trucks');
            $table->float('up_15_km', 8, 2)->default(0);
            $table->float('up_30_km', 8, 2)->default(0);
            $table->float('up_60_km', 8, 2)->default(0);
            $table->float('more_60_km', 8, 2)->default(0);
            $table->float('more_300_km', 8, 2)->default(0);
            $table->text('comment')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distance_billings');
    }
}
