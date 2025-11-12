<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->sentence(1),
            'stars' => fake()->numberBetween(1, 5),
            'author_id' => fake()->numberBetween(0, 9),
            'project_id' => fake()->numberBetween(0, 9),
        ];
    }
}
