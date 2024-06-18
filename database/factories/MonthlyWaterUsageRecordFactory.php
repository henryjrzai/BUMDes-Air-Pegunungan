<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlyWaterUsageRecord>
 */
class MonthlyWaterUsageRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'customer_id' => fake()->Unique()->numberBetween(1, 100),
            'customer_id' => function() {
                return \App\Models\Customer::all()->random()->id;
            },
            'initial_use' => fake()->numberBetween(1, 100),
            'last_use' => fake()->numberBetween(1, 100),
            'usage_value' => fake()->numberBetween(50, 500),
            'url' => 'meteran.jpg',
            // 'user_id' => fake()->numberBetween(1, 50),
            'user_id' => function() {
                return \App\Models\User::all()->random()->id;
            },
        ];
    }
}
