<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogBook>
 */
class LogBookFactory extends Factory
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
            'action_taken' => $this->faker->randomElement(['create', 'update', 'delete']),
            'user_role' => $this->faker->randomElement(['Admin', 'Employee']),
        ];
    }
}
