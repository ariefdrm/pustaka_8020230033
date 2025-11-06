<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $category = ['Science', 'horror', 'biography', 'history', 'novel', 'romance', 'comedy', 'drama'];

        return [
            //
            'title' => fake()->sentence(mt_rand(2, 8)),
            'category' => fake()->randomElement($category),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'description' => fake()->paragraph(mt_rand(5, 10)),
        ];
    }
}
