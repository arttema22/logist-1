<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MoonShine\Models\MoonshineUser;
use MoonShine\Database\Factories\MoonshineUserRoleFactory;

class RolesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoonshineUserRoleFactory::new()
            ->has(
                MoonshineUser::factory(3),
            )
            ->create([
                'name' => 'Водитель',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('roles')->insert([
            'title' => 'Администратор',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('roles')->insert([
            'title' => 'Водитель',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
    }
}
