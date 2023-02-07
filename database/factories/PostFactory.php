<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Image;
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
    public function definition()
    {
        return [
            'title' => fake()->paragraph(1),
            'slug' => fake()->unique()->slug(),
            'content' => fake()->paragraph(20),
            'excerpt' =>  substr(strip_tags(fake()->paragraph(20)), 0, 97) . '...',

            'user_id' => User::get()->random()->id,
        ];
    }
}