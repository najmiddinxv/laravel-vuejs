<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Album extends Model implements TranslatableContract
{
    use HasFactory, Translatable;


    public $translatedAttributes = ['name', 'slug', 'description'];

    protected $fillable = [
        'image',
        'status',
    ];



//     use App\Models\YourModel;

// public function show($id)
// {
//     $post = YourModel::findOrFail($id);

//     // Access translated attributes
//     $title = $post->translate('en')->title;
//     $secondTitle = $post->translate('en')->second_title;
//     // ... and so on

//     return view('posts.show', compact('post', 'title', 'secondTitle'));
// }
// Save to grepper
// Step 5: CRUD Operations
// You can create, update, and delete translatable models as you would with regular Eloquent models:

// php
// Copy code
// use App\Models\YourModel;

// // Create
// $post = YourModel::create([
//     'image' => 'example.jpg',
//     'title' => ['en' => 'English Title', 'uz' => 'Uzbek Title'],
//     // ... other translatable attributes
// ]);

// // Update
// $post->update([
//     'title' => ['en' => 'New English Title', 'uz' => 'New Uzbek Title'],
//     // ... other translatable attributes
// ]);

// // Delete
// $post->delete();

}
