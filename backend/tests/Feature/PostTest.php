<?php

namespace Tests\Feature;

use App\Models\Content\Category;
use App\Models\Content\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithoutMiddleware;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     // Artisan::call("migrate:reset");
    //     // Artisan::call("migrate");
    //     // Artisan::call("db:seed");
    //     // Artisan::call("db:seed --class=CategoriesSeeder");
    //     // Artisan::call("db:seed --class=PostSeeder");

    // }

    // public function tearDown(): void
    // {
    //     parent::tearDown();

    // }


    public function test_create_posts(): void
    {
        $title_uz = fake()->sentence();
        $title_ru = fake()->sentence();
        $title_en = fake()->sentence();

        $data = [
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => [
                'uz' => $title_uz,
                'ru' => $title_ru,
                'en' => $title_en,
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
            'view_count' => 0,
            'created_by' => 1,
            'slider' => 1,
            'status' => 0
        ];
        $response = $this->post(route('api.posts.index', $data));
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title->uz' => $title_uz]);

    }

    public function test_update_post():void
    {
        $post = Post::latest()->first();

        $newTitleUz = fake()->sentence();
        $newTitleRu = fake()->sentence();
        $newTitleEn = fake()->sentence();

        $updateData = [
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => [
                'uz' => $newTitleUz,
                'ru' => $newTitleRu,
                'en' => $newTitleEn,
            ],
            'body' => [
                'uz' => fake()->sentence(),
                'ru' => fake()->sentence(),
                'en' => fake()->sentence(),
            ],
            'view_count' => fake()->numberBetween(0, 1000),
            'slider' => 0,
            'status' => 1,
        ];
        // dd($updateData);

        $response = $this->put(route('api.posts.update', ['post'=>$post->id]), $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'title->uz' => $newTitleUz]);
    }

    public function test_get_posts(): void
    {
        $response = $this->get(route('api.posts.index'));
        $response->assertStatus(200);
    }

    public function test_show_post():void
    {
        $post = Post::latest()->first();
        $response = $this->get(route('api.posts.show',['post' => $post->id]));
        $response->assertStatus(200);
    }

    public function test_delete_post()
    {
        $post = Post::latest()->first();
        $response = $this->delete(route('api.posts.destroy',['post'=>$post->id]));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
