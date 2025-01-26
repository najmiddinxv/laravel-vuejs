<?php


namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum;

class PersonalAccessToken extends Model
{

    //==========================================================================
    //auth va refresh tokenlarni bitta qatorga saqlash uchun yozilgan Model
    //==========================================================================
    use HasApiTokens;

    protected $fillable = [
        'name',
        'last_used_at',
        'token',
        'expires_at',
        'refresh_token',
        'expires_at_refresh_token',
        'abilities',
        'user_ip',
        'user_location_info',
        'user_device_name',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $hidden = [
        'refresh_token',
        'expires_at_refresh_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'tokenable_id');
    }
}
