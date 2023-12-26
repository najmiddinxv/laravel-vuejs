<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
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
        $title = fake()->sentence();
        $slug = Str::slug($title);

        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'image' => fake()->imageUrl($width=400, $height=400),
            'view_count' => fake()->numberBetween(0, 1000),
            'status' => fake()->numberBetween(0, 3),
            // 'created_at' => Carbon::now(),
            // 'updated_at' => Carbon::now(),
        ];
    }
}
