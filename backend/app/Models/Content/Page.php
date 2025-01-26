<?php

namespace App\Models\Content;

use App\Models\Content\Category;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\TranslateMethods;
use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'body',
        'main_image',
        'status',
        'slider',
        'view_count',
    ];

    protected $casts = [
        'main_image' => 'array',
    ];

    public $translatable = ['title', 'slug', 'description', 'body'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
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
            // $model->created_by = auth()->user()->id;
            // $model->slug = Str::slug($model->title);
        });

        static::updating(function ($model) {
            $titleTranslations = $model->getTranslations('title');
            $slugs = [];

            foreach ($titleTranslations as $titleLocale => $title) {
                $slugs[$titleLocale] = Str::slug($title);
            }

            $model->slug = $slugs;
        });
    }

}
