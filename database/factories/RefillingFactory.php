<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RefillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => 1,
            'driver_id' => 3,
            'petrol_stations_id' => 1,
            'date' => '2022-09-14',
            'num_liters_car_refueling' => 10,
            'price_car_refueling' => 10,
            'cost_car_refueling' => 100,
        ];
    }
}
