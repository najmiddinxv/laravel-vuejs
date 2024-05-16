<?php

namespace App\Models\Content;

use App\Models\Content\Post;
use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'parent_id',
        'categoryable_type',
        'name',
        'icon',
        'image',
        'order',
        'status',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public $translatable = ['name'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'id','parent_id');
    }

    public function news()
    {
        return $this->hasMany(News::class,'id','parent_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class,'id','parent_id');
    }

    public function scopePostModel($q)
    {
        return $q->where('categoryable_type', Post::class)->orWhere('categoryable_type',null);
    }

    public function scopeNewsModel($q)
    {
        return $q->where('categoryable_type', News::class)->orWhere('categoryable_type',null);
    }

    public function scopeImageModel($q)
    {
        return $q->where('categoryable_type', Image::class)->orWhere('categoryable_type',null);
    }

    public function scopeTinymceFileModel($q)
    {
        return $q->where('categoryable_type', TinymceFile::class)->orWhere('categoryable_type',null);
    }

    public function scopeVideoModel($q)
    {
        return $q->where('categoryable_type', Video::class)->orWhere('categoryable_type',null);
    }

}
