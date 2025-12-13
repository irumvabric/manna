<?php

namespace Database\Factories;

use App\Models\Donator;

use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'donator_id' => Donator::factory(),
            'amount' => fake()->randomFloat(2, 100, 1000000),
            'currency' => fake()->randomElement(['BIF', 'USD', 'EUR']),
            'payment_method' => fake()->randomElement(['cash', 'card', 'mobile']),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'late']),
        ];
    }
}
