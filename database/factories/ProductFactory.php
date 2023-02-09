<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'short_description' => fake()->paragraph(1),
            'long_description' => fake()->paragraph(20),
            'regular_price' => fake()->numberBetween(50, 1000),
            'selling_price' => fake()->numberBetween(50, 1000),

            'user_id' => User::get()->random()->id,
        ];
    }
}
