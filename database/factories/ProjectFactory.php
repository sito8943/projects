<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(5),
            'leading' => fake()->paragraph(4),
            'header_image' => "https://picsum.photos/1000/1000",
            'content' => fake()->paragraph(20),
            'published_at' => fake()->dateTime(),
            'is_published' => fake()->boolean(80),
            'author_id' => fake()->numberBetween(1, 9),
        ];
    }
}
