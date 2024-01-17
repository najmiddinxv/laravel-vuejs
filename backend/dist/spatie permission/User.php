<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserPersonalInfo;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    // protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $fillable = [
        // 'parent_id',
        // 'last_seen'
        'id',
        'username',
        'password',
        'uuid',
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'sex',
        'email',
        'position',
        'bank_branch_id',
        'phone',
        'role_id',
        'is_active',
        // 'status',
        'user_type',
        'avatar',
        'file',
        'is_punished',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute(){
        return  "{$this->first_name} {$this->last_name} {$this->middle_name}";
    }

    public const MALE = 1;
    public const FEMALE = 2;

    public const ACTIVE = 1;
    public const INACTIVE = 99;
    public const USER_TYPE_BACKEND = 1;
    public const USER_TYPE_FRONTEND = 2;

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function position_name():BelongsTo
    {
        return $this->belongsTo(Position::class, 'position', 'id');
    }

    public function bank_branch(): BelongsTo
    {
        return $this->belongsTo(BankBranch::class, 'bank_branch_id', 'id');
    }

    public function action_logs(): HasMany
    {
        return $this->hasMany(ActionLog::class, 'user_id', 'id');
    }

    public function completed_course(): HasMany
    {
        return $this->hasMany(CourseUserCompleted::class, 'user_id', 'id')->where('status', 1);
    }

    public function test_enrollment(): HasMany
    {
        return $this->hasMany(TestEnrollment::class, 'test_user_id', 'uuid')->where('status', 1);
    }

    public function user_created_tests()
    {
        return $this->hasMany(TestNames::class, 'id', 'instructor_id');
    }
    public function punished_users():HasMany
    {
        return $this->hasMany(PunishedUser::class, 'user_id', 'id');
    }

    public function user_permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'model_has_permissions','model_id')->where('model_type', 'App\Models\User');
    }

    public function user_roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'model_has_roles','model_id')->where('model_type', 'App\Models\User');
    }

    // public function hasRole($role)
    // {
    //     $id = auth()->user()->id;

    //     if ($role == 'admin') {
    //         $role_id = 1;
    //     } elseif ($role == 'business_trainer') {
    //         $role_id = 2;
    //     } elseif ($role == 'hr') {
    //         $role_id = 4;
    //     } elseif ($role == 'manager') {
    //         $role_id = 5;
    //     } else {
    //         $role_id = 9;
    //     }

    //     $query = User::where('id', $id)->where('role_id', $role_id)->first();

    //     if (is_null($query)) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }


}
