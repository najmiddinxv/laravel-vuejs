<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = "notifications";
    protected $fillable = [
        // 'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
