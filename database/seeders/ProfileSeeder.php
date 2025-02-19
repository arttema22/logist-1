<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => 1,
            'last_name' => 'Гусев',
            'first_name' => 'Артем',
            'sec_name' => 'Александрович',
            'phone' => '89119268188',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 2,
            'last_name' => 'Вакуленко',
            'first_name' => 'Денис',
            'sec_name' => 'Сергеевич',
            'phone' => '89111840145',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 3,
            'last_name' => 'Хазиуллин',
            'first_name' => 'Андрей',
            'sec_name' => 'Рафисович',
            'phone' => '89214432509',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 4,
            'last_name' => 'Смирнов',
            'first_name' => 'Сергей',
            'sec_name' => 'Александрович',
            'phone' => '89215777445',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 5,
            'last_name' => 'Карпович',
            'first_name' => 'Александр',
            'sec_name' => 'Иванович',
            'phone' => '89219811516',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 6,
            'last_name' => 'Молчанов',
            'first_name' => 'Александр',
            'sec_name' => 'Антонович',
            'phone' => '89312629190',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 7,
            'last_name' => 'Лукин',
            'first_name' => 'Вячеслав',
            'sec_name' => 'Владимирович',
            'phone' => '89657711838',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 8,
            'last_name' => 'Мещеряков',
            'first_name' => 'Алексей',
            'sec_name' => 'Николаевич',
            'phone' => '89218600782',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 9,
            'last_name' => 'Давыденков',
            'first_name' => 'Игорь',
            'sec_name' => 'Сергеевич',
            'phone' => '89219762765',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 10,
            'last_name' => 'Екимов',
            'first_name' => 'Алексей',
            'sec_name' => 'Сергеевич',
            'phone' => '89531509048',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 11,
            'last_name' => 'Майоров',
            'first_name' => 'Иван',
            'sec_name' => 'Яковлевич',
            'phone' => '89216540978',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 12,
            'last_name' => 'Леонтьев',
            'first_name' => 'Александр',
            'sec_name' => 'Анатольевич',
            'phone' => '89214270568',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 13,
            'last_name' => 'Владимиров',
            'first_name' => 'Алексей',
            'sec_name' => 'Сергеевич',
            'phone' => '89312148432',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 14,
            'last_name' => 'Тилик',
            'first_name' => 'Денис',
            'sec_name' => 'Дмитриевич',
            'phone' => '89313219697',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
        DB::table('profiles')->insert([
            'user_id' => 15,
            'last_name' => 'Думцев',
            'first_name' => 'Игорь',
            'sec_name' => 'Александрович',
            'phone' => '89212189981',
            'created_at' => '2022-09-01 09:00:00',
            'updated_at' => '2022-09-01 09:00:00',
        ]);
    }
}
