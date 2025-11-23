<?php

namespace Database\Factories;

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
            'surname' => fake()->word(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'payment_method' => fake()->word(),
            'target_amount' => fake()->randomFloat(0, 0, 9999999999.),
            'periodicity' => fake()->numberBetween(-10000, 10000),
            'currency' => fake()->regexify('[A-Za-z0-9]{default}'),
        
        ];
    }
}
