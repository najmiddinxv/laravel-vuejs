<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function contactSubject()
    {
        return $this->belongsTo(ContactSubject::class, 'contact_subject_id','id');
    }

}
