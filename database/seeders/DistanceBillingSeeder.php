<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistanceBillingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distance_billings')->insert([
            'type_truck_id' => 1,
            'up_15_km' => 4500.00,
            'up_30_km' => 7000.00,
            'up_60_km' => 7000.00,
            'more_60_km' => 115.00,
            'more_300_km' => 95.00,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('distance_billings')->insert([
            'type_truck_id' => 2,
            'up_15_km' => 4000.00,
            'up_30_km' => 4000.00,
            'up_60_km' => 110.00,
            'more_60_km' => 110.00,
            'more_300_km' => 95.00,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('distance_billings')->insert([
            'type_truck_id' => 3,
            'up_15_km' => 4500.00,
            'up_30_km' => 7000.00,
            'up_60_km' => 7000.00,
            'more_60_km' => 120.00,
            'more_300_km' => 100.00,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('distance_billings')->insert([
            'type_truck_id' => 4,
            'up_15_km' => 6000.00,
            'up_30_km' => 8000.00,
            'up_60_km' => 10000.00,
            'more_60_km' => 120.00,
            'more_300_km' => 100.00,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
    }
}
