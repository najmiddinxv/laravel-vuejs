<?php

namespace App\Models;

use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, TranslateMethods, HasTranslations;

    protected $fillable = [
        'parent_id',
        'name',
        'category_type',
        'icon',
        'image',
        'order',
    ];

     //attributs
     public function getTestAttribute()
     {
         return 'bu test append va shu category nomi : '. $this->name;
     }

     // protected $with = ['user'];
     // protected $appends = ['Func];


     // public function customer():BelongsTo
     // {
     //     return $this->belongsTo(User::class,'customer_id','id');
     // }

     // protected $casts = [
     //     'images' => 'array',
     //     'from' => 'array',
     //     'to' => 'array',
     // ];

     // public function setDateOfOrderAttribute($value)
     // {
     //     $this->attributes['date_of_order'] = date("Y-m-d", strtotime($value));
     // }

     // public function getDateOfOrderAttribute($value)
     // {
     //     return date("d.m.Y", strtotime($value));
     // }


     // function name() : Attribute
     // {
     //     $locale = app()->getLocale();

     //     return Attribute::make(
     //         get: fn ($value) => $value[$locale],
     //         set: fn ($value) => [$locale => $value],
     //     );
     // }


     //=============================translate===================================
     //translate uchun
     public $translatable = ['name']; // bu web uchun

     // bu esa api translate uchun
     // use App\Traits\TranslateMethods; shu yerdan olib tarjima qilayapti
     // {"uz":"Sport yangiliklari","ru":"Спортивные новости","en":"Sports news"}
     // bazada shu tartibda saqlanaypti
     //postmanda headerdan Accept-Language:uz qilib jonatilayapti

     public function getNameAttribute($value)
     {
         return $this->getTranslatedAttribute($value);
     }
    //har bitta columnni nomini shunda yozish kerak tarjima uchun
    //  public function getIconAttribute($value)
    //  {
    //      return $this->getTranslatedAttribute($value);
    //  }

    //  protected $casts = [
    //      'name'       => TranslatableJson::class,
    //  ];
     // public function getDescriptionAttribute($value)
     // {
     //     return $this->getTranslatedAttribute($value);
     // }
     // public function getBodyAttribute($value)
     // {
     //     return $this->getTranslatedAttribute($value);
     // }
     //=============================translate===================================

     /*
     *
     *   use App\Traits\EscapeUniCodeJson;
     *   mana shu fayl spatie translatable ni ishlatganda kiril harflar jsonga o'grganda /001ad/ kod bolib qoladi
     *   shuni qanday yozilgan bolsa shunday kiril harflarda jsonga ogirib berish uchun ishlatiladi
     *******************************
     *   use App\Traits\TranslateMethods; bu fayl esa api chiqarganda tarjima uchun kerak
     *   headerga shuni qo'shish kerak apidan foydalanib tarjima qilaman degan kishi headerga mana shuni qoshadi postmanda -> Accept-Language uz
     *
       va ustun nomini yozib mana shu methodni yozadi misol uchun bizda name degan ustun nomi bor
         public function getNameAttribute($value)
       {
        return $this->getTranslatedAttribute($value);
       }
       va yana description degan ustun ham bor bolsa uni ham tarjima qilish kerak bolsa
         public function getDescriptionAttribute($value)
       {
        return $this->getTranslatedAttribute($value);
       }
       va hokozo shu tartibda ketaveradi
     *
     *
     *
     */
}
