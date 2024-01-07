<?php

namespace App\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// class News extends Model implements TranslatableContract
class News extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'title',
        'slug',
        'description',
        'body',
        'image',
    ];

    protected $fillable = [
        'category_id',
        'created_by',
        'status',
        'slider',
        'view_count',
    ];

    public function translation()
    {
        return $this->hasOne(NewsTranslation::class, 'news_id', 'id');
    }

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class, 'news_id', 'id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }



}
