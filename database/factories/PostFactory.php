<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $published = rand(true, false);
        $published_at = $published ? fake()->dateTimeThisMonth() : null;
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(5, true),
            'image_path' => fake()->imageUrl(),
            'published' => $published,
            'user_id' => rand(1, 3),
            'category_id' => rand(1, 3),
            'published_at' => $published_at,
        ];
    }
}
