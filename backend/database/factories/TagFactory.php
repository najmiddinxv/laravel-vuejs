<?php

namespace Database\Factories;

use App\Models\Content\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => [
                'uz' => $this->faker->word . ' tag',
                'ru' => $this->faker->word . ' tag',
                'en' => $this->faker->word . ' tag',
            ],
        ];
    }

}

