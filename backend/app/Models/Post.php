<?php

namespace App\Models;

use App\Traits\TranslatableJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, Searchable;
    // use HasTranslations;
    // use TranslateMethods;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'body',
        'image',
        'view_count',
        'status',
    ];


    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // public function category():BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }


    // public function category(): MorphOne
    // {
    //     return $this->morphOne(Category::class, 'categoryable');
    // }

    public function category():MorphMany
    {
        return $this->morphMany(Category::class, 'categoryable');
    }


}
