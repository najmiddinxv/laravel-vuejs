<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $table = 'news_translations';
    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'slug',
        'description',
        'body',
        'main_image',
    ];

    protected $casts = [
        'main_image' => 'array',
    ];
}
