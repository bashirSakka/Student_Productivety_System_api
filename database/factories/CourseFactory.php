<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement(['Calculus II', 'Data Structures', 'Linear Algebra', 'Physics I', 'Web Development', 'Organic Chemistry']),
            'code' => strtoupper(fake()->lexify('???')) . ' ' . fake()->numerify('###'),
            'instructor' => fake()->name(),
            'credits' => fake()->randomElement([1.0, 2.0, 3.0, 4.0]),
            'color' => fake()->hexColor(),
            'semester' => fake()->randomElement(['Fall', 'Spring', 'Summer']) . ' ' . fake()->year(),
            'grade' => fake()->randomElement(['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C']),
            'status' => fake()->randomElement(['active', 'completed']),
        ];
    }
}