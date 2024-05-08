<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Video extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'category_id',
        'title',
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

    public $translatable = ['title','description'];

    protected $casts = [
        'thumbnail' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->uploaded_by = auth()->user()->id;
        });

        static::updating(function ($model) {
            $model->uploaded_by = auth()->user()->id;
        });
    }

}
