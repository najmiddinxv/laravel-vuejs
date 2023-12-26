<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'message',
    ];

    public function sender():BelongsTo
    {
        return $this->belongsTo(User::class,'from_id','id');
    }

    public function recipient():BelongsTo
    {
        return $this->belongsTo(User::class,'to_id','id');
    }


}
