<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    public const STATUS_INCTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const USER_TYPE_USERPROFILE = 2;
    public const USER_TYPE_BACKEND = 1;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'username',
        'email',
        'phone_number',
        'user_type',
        'status',
        'avatar',
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
        'phone_number_confirmed_at' => 'datetime',
        'password' => 'hashed',
    ];
}
