<?php

namespace Database\Factories;

use App\Models\Donator;
use App\Models\Foreign;
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
            'amount' => fake()->randomFloat(0, 0, 9999999999.),
            'currency' => fake()->regexify('[A-Za-z0-9]{default}'),
            'payment_method' => fake()->word(),

        ];
    }
}
