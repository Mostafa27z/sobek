<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city() . ' Airport',
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'iata' => strtoupper($this->faker->unique()->lexify('???')),
            'can_be_from' => true,
            'can_be_to' => true,
            'description' => $this->faker->sentence(),
        ];
    }
}
