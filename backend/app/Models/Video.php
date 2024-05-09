<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'hls_path',
        'original_path',
        'mime_type',
        'size',
        'thumbnail',
        'download_count',
        'status',
        'uploaded_by',
    ];

    public $translatable = ['title','description','slug'];

    protected $casts = [
        'thumbnail' => 'array',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function uploadedBy() : BelongsTo
    {
        return $this->belongsTo(User::class,'uploaded_by','id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $titleTranslations = $model->getTranslations('title');
            $slugs = [];

            foreach ($titleTranslations as $titleLocale => $title) {
                $slugs[$titleLocale] = Str::slug($title);
            }

            $model->slug = $slugs;
            $model->uploaded_by = auth()->user()->id;
        });

        static::updating(function ($model) {
            $titleTranslations = $model->getTranslations('title');
            $slugs = [];

            foreach ($titleTranslations as $titleLocale => $title) {
                $slugs[$titleLocale] = Str::slug($title);
            }

            $model->slug = $slugs;
            $model->uploaded_by = auth()->user()->id;
        });
    }

}
