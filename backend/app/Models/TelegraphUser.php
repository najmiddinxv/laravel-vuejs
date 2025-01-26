<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegraphUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'name',
        'age',
        'email',
        'phone_number',
        'step',
    ];

}
