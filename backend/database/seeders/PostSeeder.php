<?php

namespace Database\Seeders;

use App\Models\Content\Post;
use App\Models\Content\Tag;
use Database\Factories\PostFactory;
use Database\Factories\TagFactory;
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

        // Post::factory(20)->create(); //bu ishlamayapti Post.php modelini Models/Content/Post.php papkasiga ko'chirganim uchun
        //shuning uchun mana shunday ishlatayabman pastgi qatordagi kodga qara
        // PostFactory::new()->count(1)->create();

        $tags = TagFactory::new()->count(10)->create();
        PostFactory::new()->count(20)->create()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        dump('post seeder done');
    }

}
