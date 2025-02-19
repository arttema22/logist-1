<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteBillingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_billings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('start');
            $table->string('finish');
            $table->boolean('is_static')->default(0);
            $table->Integer('length')->nullable();;
            $table->float('price', 8, 2)->nullable();
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
        Schema::dropIfExists('route_billings');
    }
}
