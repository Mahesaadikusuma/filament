<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
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
        $title = $this->faker->sentence();
        return [
            "user_id" => User::factory(),
            "title" => $title,
            "body" => $this->faker->paragraph(10),
            "slug" => Str::slug($title),
            "image" => $this->faker->imageUrl(),
            "published_at" => $this->faker->dateTimeBetween("-1 Week", "+1 Week"),
            "featured" => $this->faker->boolean(),

        ];
    }
}
