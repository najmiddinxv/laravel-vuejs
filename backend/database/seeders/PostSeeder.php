<?php

namespace Database\Seeders;

use App\Models\Post;
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



        //you can also use the method
        // PropertyGroup::factory(random_int(5, 10))
        //     ->has(
        //           Property::factory()
        //               ->hasValues(random_int(5, 10))->count(random_int(5, 10))
        //         , 'properties'
        //     )
        //     ->create();
        // dump('create property group');

        
        // $posts = Post::factory()->count(20000)->make();

        // $posts->chunk(2000)->each(function ($chunk) {
        //     Post::insert($chunk->toArray());
        // });//5,200.84 ms DONE

        Post::factory(20)->create(); // 11,809.66 ms DONE
        dump('post seeder done');
    }

}
