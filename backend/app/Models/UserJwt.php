<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'last_name', //familya
        'first_name', //ism
        'middle_name', //sharif
        'email',
        'phone_number',
        'user_type',
        'status',
        'avatar',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_confirmed_at' => 'datetime',
        'password' => 'hashed',
        'avatar' => 'array',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFullNameAttribute() {
        return "{$this->last_name} {$this->first_name} {$this->middle_name}";
    }

    public function user_permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'model_has_permissions','model_id')->where('model_type', 'App\Models\User');
    }

    public function user_roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles','model_id')->where('model_type', 'App\Models\User');
    }

}
