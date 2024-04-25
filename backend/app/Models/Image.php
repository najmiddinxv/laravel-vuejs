<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Image extends Model
{
    use HasFactory, TranslateMethods, HasTranslations, EscapeUniCodeJson;

    protected $fillable = [
        'category_id',
        'name',
        'path',
        'mime_type',
        'size',
        // 'download_count',
        'uploaded_by',
        'status',
    ];

    protected $casts = [
        'path' => 'array',
    ];

    public $translatable = ['name'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function uploadedBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by','id');
    }
}
