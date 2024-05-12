<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BaseModel extends Model
{
    //ushbu booted (model yuklanganda degani) metdoni har bitta modelga yozsak ham bo'ladi aslida
    //lekin status video,news,post,image,category kabi bir qancha tablelarda mavjud bo'lgani uchun
    //global qilish maqsadida base model degan class yaratilib shu yerga yozildi endi ushbu modeldan meros olinsa bo'ldi

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);

        //yoki shu yerga ham yozsak bo'ladi
        // static::addGlobalScope('status', function (Builder $builder) {
        //     $builder->where('status', 1);
        // });
    }
}
