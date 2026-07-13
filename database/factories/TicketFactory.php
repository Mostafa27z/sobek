<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        $departureDate = $this->faker->dateTimeBetween('+1 day', '+1 month');
        $tripType = $this->faker->randomElement(['one_way', 'round_trip']);

        return [
            'from_city_id' => City::factory(),
            'to_city_id' => City::factory(),
            'departure_date' => $departureDate->format('Y-m-d H:i:s'),
            'trip_type' => $tripType,
            'return_date' => $tripType === 'round_trip'
                ? $this->faker->dateTimeBetween($departureDate->modify('+1 day'), '+2 months')
                : null,
            'number_of_adults' => $this->faker->numberBetween(1, 5),
            'number_of_children' => $this->faker->numberBetween(0, 3),
            'number_of_babies' => $this->faker->numberBetween(0, 2),
            'price' => $this->faker->randomFloat(2, 500, 10000),
            'description' => $this->faker->paragraph(),
            'is_active' => true,
        ];
    }
}
