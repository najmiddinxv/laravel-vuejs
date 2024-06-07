<?php

namespace Tests\Feature;

use App\Models\Content\Post;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class PostTest extends TestCase
{
    use WithoutMiddleware;
    // use RefreshDatabase;

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

    // public function test_get_posts(): void
    // {
    //     $response = $this->get(route('admin.post.index'));
    //     $response->assertStatus(200);
    // }

    // public function test_create_posts(): void
    // {
    //     Storage::fake('public'); // Set the disk to use for file storage
    //     $image = UploadedFile::fake()->image('post_image.jpg');

    //     $data = [
    //         'category_id'=> 1,
    //         'title'=> 'test-post-created',
    //         'slug'=> Str::slug('test-post-created'),
    //         'description' => 'Lorem ipsum, dolor sit explicabo mpedit hic quos.',
    //         'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum debitis atque minima in cupiditate amet, natus qui dignissimos voluptatum quaerat architecto, explicabo eius error voluptates laborum earum impedit hic quos.',
    //         'image' => $image,
    //     ];
    //     // $post = Post::factory()->create();

    //     // $response = $this->post('post/store', $post->toArray());
    //     $response = $this->post('post/store', $data);
    //     $response->assertStatus(302);
    //     $this->assertDatabaseHas('posts', ['title' => 'test-post-created']);
    //     Storage::disk('public')->assertExists('post_images/' . $image->hashName());

    // }

    // public function test_show_post():void
    // {
    //     $post = Post::first();

    //     $response = $this->get(route('backend.posts.show',['post' => $post->id]));
    //     // dd($response->getContent());
    //     $response->assertStatus(200);
    // }


    public function test_delete_post()
    {
        // PostFactory::new()->count(1)->create();
        $post = Post::latest()->first();
        // dd($post->id);
        $response = $this->delete(route('backend.posts.destroy',['post'=>$post->id]));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
