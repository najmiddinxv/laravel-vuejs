<?php

namespace App\Models\Content;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Word extends Model
{
    use HasFactory, HasTranslations, TranslateMethods, EscapeUniCodeJson;

    public $translatable = ['value'];

    protected $fillable = [
        'key',
        'value',
    ];

}
