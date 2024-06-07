<?php

namespace Database\Seeders;

use App\Models\Content\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
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
