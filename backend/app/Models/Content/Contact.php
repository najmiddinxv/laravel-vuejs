<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_subject_id',
        'name',
        'phone_number',
        'email',
        'body',
        'status',
    ];

    public function contactSubject():BelongsTo
    {
        return $this->belongsTo(ContactSubject::class);
    }

}
