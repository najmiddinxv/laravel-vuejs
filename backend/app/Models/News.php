<?php

namespace App\Models;


use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model implements TranslatableContract
// class News extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'title',
        'slug',
        'description',
        'body',
        'main_image'
    ];

    protected $fillable = [
        'category_id',
        'created_by',
        'status',
        'slider',
        'view_count'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->created_by = auth()->user()->id;
        });

        static::updating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }


    public function translation():HasOne
    {
        return $this->hasOne(NewsTranslation::class, 'news_id', 'id');
    }

    public function translations():HasMany
    {
        return $this->hasMany(NewsTranslation::class, 'news_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
