<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const STATUS_INCTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_BACKEND = 10;

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'phone_number',
        'status',
        'telegram_full_name',
        'telegram_phone_number',
        'telegram_chat_id',
        'telegram_username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_confirmed_at	' => 'datetime',
        'password' => 'hashed',
    ];
}
