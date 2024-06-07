<?php

namespace Database\Seeders;

use App\Models\Content\Post;
use App\Models\Content\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::truncate();

        // $posts = Post::factory()->count(20000)->make();// 11,809.66 ms DONE

        // $posts->chunk(2000)->each(function ($chunk) {
        //     Post::insert($chunk->toArray());
        // });//5,200.84 ms DONE

        // Post::factory(20)->create();

        // PostFactory::new()->count(1)->create();

        $tags = Tag::factory(10)->create();
        Post::factory(20)->create()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        dump('post seeder done');
    }

}
