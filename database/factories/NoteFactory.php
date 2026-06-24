<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'course_tag' => fake()->word(),
            'title' => fake()->sentence(4),
            'content' => fake()->optional(0.8)->paragraphs(3, true),
            'pinned' => fake()->boolean(20),
        ];
    }
}
