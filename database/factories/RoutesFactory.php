<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoutesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => now(),
            'owner_id' => 1,
            'driver_id' => 3,
            'dir_type_trucks_id' => 1,
            'cargo_id' => 1,
            'payer_id' => 1,
            'address_loading' => $this->faker->name(),
            'address_unloading' => $this->faker->name(),
            'route_length' => 77,
            'price_route' => 999.99,
            'number_trips' => 1,
            'summ_route' => 888,
        ];
    }
}
