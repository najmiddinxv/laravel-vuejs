<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinymceFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'path',
        'mime_type',
        'size',
        'thumbnail',
        'download_count',
        'status',
        'uploaded_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
