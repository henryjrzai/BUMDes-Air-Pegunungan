<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MontlyBill>
 */
class MontlyBillFactory extends Factory
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
            'monthly_water_usage_record_id' => fake()->numberBetween(1, 100),
            'billing_costs' => fake()->numberBetween(50000, 3500000),
            'status' => fake()->randomElement(['Paid', 'Unpaid']),
        ];
    }
}
