<?php

namespace Database\Seeders;

use App\Models\Category;;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $data = [
            [
                'name' =>'{"uz":"Sport yangiliklari","ru":"Спортивные новости","en":"Sports news"}'
            ],
            [
                'name' =>'{"uz":"Mahalliy yangiliklar","ru":"Местные новости","en":"Local news"}'
            ],
            [
                'name' =>'{"uz":"Xorij yangiliklari","ru":"Зарубежные новости","en":"Foreign news"}'
            ],
        ];

        Category::insert($data);

        dump('Category seeder done');
    }
}
