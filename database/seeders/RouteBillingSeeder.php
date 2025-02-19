<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteBillingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Пикалево',
            'is_static' => 0,
            'length' => 460,
            'created_at' => '2022-09-02 09:00:00',
            'updated_at' => '2022-09-02 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Синявино',
            'is_static' => 0,
            'length' => 237,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Невская Дубровка',
            'is_static' => 0,
            'length' => 234,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Сертолово (ЛСР)',
            'is_static' => 0,
            'length' => 230,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Ковалево',
            'is_static' => 0,
            'length' => 220,
            'created_at' => '2022-09-03 09:00:00',
            'updated_at' => '2022-09-03 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Отрадное',
            'is_static' => 0,
            'length' => 224,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'СПб, Партизанская 14',
            'is_static' => 0,
            'length' => 210,
            'created_at' => '2022-09-04 09:00:00',
            'updated_at' => '2022-09-04 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'СХТ',
            'finish' => 'Глинка',
            'is_static' => 0,
            'length' => 205,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'Волхонское',
            'finish' => 'Шушары',
            'is_static' => 1,
            'price' => 7000,
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('route_billings')->insert([
            'start' => 'Волхонское',
            'finish' => 'Пушкин',
            'is_static' => 1,
            'price' => 7000,
            'created_at' => '2022-09-04 09:01:00',
            'updated_at' => '2022-09-04 09:01:00',
        ]);
    }
}
