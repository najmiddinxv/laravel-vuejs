<?php

namespace App\Models;

use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Word extends Model
{
    use HasFactory, HasTranslations, TranslateMethods;

    // public $timestamps = false;

    public $translatable = ['value'];

    protected $fillable = [
        'key',
        'value',
    ];

}
