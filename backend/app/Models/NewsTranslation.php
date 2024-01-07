<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'locale',
        'title',
        'slug',
        'description',
        'body',
        'image',
    ];
}
