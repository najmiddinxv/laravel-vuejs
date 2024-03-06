<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\categories;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        User::truncate();
        User::factory()->create([
            'first_name' => 'najmiddin',
            'last_name' => 'najmiddin',
            'middle_name' => 'najmiddin',
            'user_type' => 1,
            'status' => 1,
            'email' => 'bekdevz@gmail.com',
            'email_verified_at' => now(),
            'password' => '01230123', // password
            'remember_token' => Str::random(10),
        ]);
        User::factory(10)->create();

        dump('User seeder done');
    }
}
