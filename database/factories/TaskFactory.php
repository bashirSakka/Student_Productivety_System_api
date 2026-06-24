<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'in_progress', 'completed']);
        return [
            'user_id'      => User::factory(),
            'title'        => fake()->sentence(4),
            'description'  => fake()->optional(0.7)->paragraph(),
            'due_at'       => fake()->optional(0.8)->dateTimeBetween('now', '+3 months'),
            'priority'     => fake()->randomElement(['low', 'medium', 'high']),
            'status'       => $status,
            'completed_at' => $status === 'completed' ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }
}
