<?php

namespace App\Models\Content;

use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class VerificationCode extends Model
{
    use HasFactory, HasTranslations, TranslateMethods, EscapeUniCodeJson;
    protected $connection = 'mysql';
    protected $table = 'verification_codes';
    protected $fillable = ['user_id', 'sms_code', 'expire_at','phone_number'];
    public $translatable = [];
}
