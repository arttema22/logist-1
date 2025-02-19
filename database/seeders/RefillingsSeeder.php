<?php

namespace Database\Seeders;

use App\Models\Refilling;
use Database\Factories\RefillingsFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefillingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Refilling::factory()->count(15)->create();
    }
}
