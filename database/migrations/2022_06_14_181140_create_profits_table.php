<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->default(date(now()));
            $table->string('title');
            $table->BigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->BigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->float('saldo_start', 8, 2)->default(0);
            $table->float('sum_salary', 8, 2)->default(0);
            $table->float('sum_refuelings', 8, 2)->default(0);
            $table->float('sum_routes', 8, 2)->default(0);
            $table->float('sum_services', 8, 2)->default(0);
            $table->float('sum_accrual', 8, 2)->default(0);
            $table->float('sum_amount', 8, 2)->default(0);
            $table->float('saldo_end', 10, 2)->default(0);
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
        Schema::dropIfExists('profits');
    }
}
