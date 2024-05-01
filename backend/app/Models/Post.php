<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;
    // use Searchable;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'body',
        'main_image',
        // 'images', //postni ichida slider rasmlarni chiqarish uchun
        'created_by',
        'status',
        'slider',
        'view_count',
    ];

    protected $casts = [
        'main_image' => 'array',
    ];

    public $translatable = ['title', 'slug', 'description', 'body'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function category(): MorphOne
    // {
    //     return $this->morphOne(Category::class, 'categoryable');
    // }

    public function createdBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }



}
