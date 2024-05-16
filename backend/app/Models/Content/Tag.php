<?php

namespace App\Models\Content;

use App\Models\Content\Post;
use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, HasTranslations, TranslateMethods, EscapeUniCodeJson;

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

    public function scopePostModel($q)
    {
        return $q->where('tagsable_type',Post::class)->orWhere('tagsable_type',null);
    }

    public function scopeNewsModel($q)
    {
        return $q->where('tagsable_type',News::class)->orWhere('tagsable_type',null);
    }

}
