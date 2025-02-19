<?php

namespace Database\Seeders;

use App\Models\Routes;
use Illuminate\Database\Seeder;

class RoutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Routes::factory()->count(5)->create();
    }
}
