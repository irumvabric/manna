<?php

namespace Database\Factories;

use App\Models\Donator;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonatorFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'payment_method' => fake()->randomElement(['Cash', 'Mobile Money', 'Bank/Card']),
            'target_amount' => fake()->randomFloat(2, 10, 10000),
            'periodicity' => fake()->randomElement([
                Donator::PERIOD_MONTHLY,
                Donator::PERIOD_ONE_TIME,
                Donator::PERIOD_SEMIANNUALLY,
                Donator::PERIOD_YEARLY
            ]),
            'currency' => fake()->randomElement(['BIF', 'USD', 'EUR']),
        ];
    }
}
