<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meter_id' => fake()->unique()->randomNumber(5),
            'name' => fake()->name(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'dusun' => fake()->randomElement(['Dusun 1', 'Dusun 2', 'Dusun 3', 'Dusun 4']),
            'rt' => fake()->randomElement(['RT 1', 'RT 2', 'RT 3', 'RT 4']),
            'rw' => fake()->randomElement(['RW 1', 'RW 2', 'RW 3', 'RW 4']),
        ];
    }
}
