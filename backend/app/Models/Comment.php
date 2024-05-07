<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    // user SoftDeletes;

    protected $fillable = [
        'parent_id',
        'user_id',
        'body',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies():HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user', 'replies');
    }
}
