<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
            'customer_id' => \App\Models\Customer::inRandomOrder()->first()->id,
            'invoice_number' => fake()->unique()->numerify('INV-#####'),
            'amount' => fake()->randomFloat(2, 100, 10000),
            'date' => fake()->date('Y-m-d'),
            'description' => fake()->sentence(),
            'currency' => fake()->randomElement(['EGP', 'USD']),
            'payment_status' => fake()->randomElement(['pending', 'paid', 'partially_paid', 'failed', 'refunded', 'overdue']),
        ];
    }
}
