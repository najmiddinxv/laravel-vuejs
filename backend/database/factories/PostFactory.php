<?php

namespace Database\Factories;

use App\Models\Content\Category;
use App\Models\Content\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title_uz = fake()->sentence();
        $title_ru = fake()->sentence();
        $title_en = fake()->sentence();

        return [
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => [
                'uz' => $title_uz,
                'ru' => $title_ru,
                'en' => $title_en,
            ],
            'slug' => [
                'uz' => Str::slug($title_uz),
                'ru' => Str::slug($title_ru),
                'en' => Str::slug($title_en),
            ],
            'description' => [
                'uz' => fake()->sentence(),
                'ru' => fake()->sentence(),
                'en' => fake()->sentence(),
            ],
            'body' => [
                'uz' => fake()->sentence(),
                'ru' => fake()->sentence(),
                'en' => fake()->sentence(),
            ],
            'main_image' => [
                'large' => fake()->imageUrl($width=800, $height=600),
                'middle' => fake()->imageUrl($width=400, $height=400),
                'small' => fake()->imageUrl($width=100, $height=100),
            ],
            'view_count' => fake()->numberBetween(0, 1000),
            'created_by' => 1,
            'slider' => 1,
            'status' => fake()->numberBetween(0,1),
            // 'created_at' => Carbon::now(),
            // 'updated_at' => Carbon::now(),
        ];
    }


}

