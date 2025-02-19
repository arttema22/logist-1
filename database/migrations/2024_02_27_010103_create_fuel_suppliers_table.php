<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contract_id');
            $table->string('number');
            $table->string('inn');
            $table->string('kpp');
            $table->dateTimeTz('date');
            $table->float('balance', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_suppliers');
    }
}
