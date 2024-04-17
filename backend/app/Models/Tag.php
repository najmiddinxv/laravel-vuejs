<?php

namespace App\Models;

use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, HasTranslations, TranslateMethods;

    // public $timestamps = false;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'tagsable_type',
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}
