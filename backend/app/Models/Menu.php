<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $table = 'menu';

    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'position',
        'menu_order',
        'status',
    ];

    public $translatable = ['name','url'];

    public const HEADER_MENU = 1;
    public const FOOTER_MENU = 2;
    public const SIDEBAR_MENU = 3;

    protected static function booted()
    {
        static::created(function ($menu) {
            Cache::forget('menu');
        });
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }


}
