<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TinymceFile extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'path',
        'mime_type',
        'size',
        'download_count',
        'status',
        'uploaded_by',
    ];

    public $translatable = ['name','description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
