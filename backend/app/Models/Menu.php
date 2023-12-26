<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'position',
        'menu_order',
    ];

    public function children():HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }



}
