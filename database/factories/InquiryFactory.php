<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'from_city' => $this->faker->city(),
            'to_city' => $this->faker->city(),
            'desired_date' => $this->faker->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'number_of_adults' => $this->faker->numberBetween(1, 4),
            'number_of_children' => $this->faker->numberBetween(0, 2),
            'number_of_babies' => $this->faker->numberBetween(0, 1),
            'message' => $this->faker->text(200),
            'status' => 'pending',
        ];
    }
}
