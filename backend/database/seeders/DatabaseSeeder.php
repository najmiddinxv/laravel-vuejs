<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'full_name' => 'najmiddin bek',
            'username' => 'bekdevz',
            'email' => 'bekdevz@gmail.com',
            'email_verified_at' => now(),
            'password' => '01230123', // password
            'remember_token' => Str::random(10),
        ]);
        // User::factory(10)->create();

        $this->call([
            // CategoriesSeeder::class,
            // PostSeeder::class,

        ]);


        //you can also use the method
        // PropertyGroup::factory(random_int(5, 10))
        //     ->has(
        //           Property::factory()
        //               ->hasValues(random_int(5, 10))->count(random_int(5, 10))
        //         , 'properties'
        //     )
        //     ->create();
        // dump('create property group');

    }
}
