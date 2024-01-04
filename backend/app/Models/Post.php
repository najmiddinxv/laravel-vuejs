<?php

namespace App\Models;

use App\Traits\TranslatableJson;
use App\Traits\TranslateMethods;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, Searchable;
    // use HasTranslations;
    use TranslateMethods;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'body',
        'image',
        'view_count',
        'status',
    ];


    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // protected $casts = [
    //     //  mana shu tartibda tarjima qilsak ham bo'ladi buning uchun hech qanaqa package kerak emas
    //     // App\Traits\TranslatableJson; faylga qara
    //     //getNameAttribute buni yozib o'tirmasdan birdan tarjima shuni yozsak birdan tarjima qilib yuboradi
    //     // 'title' => TranslatableJson::class,

    //     // 'title' => 'array',
    // ];
    //bu esa bittalab tarjima qiladi har bitta colum nameni shunday yozib chiqish kerak
    // public function getTitleAttribute($value)
    // {
    //     return $this->getTranslatedAttribute($value);
    // }
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->getTranslatedAttribute($value),
            // set: fn (string $value) => strtolower($value),
        );
    }

    // public function getBodyAttribute($value)
    // {
    //     return $this->getTranslatedAttribute($value);
    // }


    // agar yuqoridagi app/traits/TranslatableJson.php va app/traits/TranslateMethods.php
    // fayllardan foydalansak
    // https://spatie.be/docs/laravel-translatable/v6/introduction
    // bundan foydalanishimiz shart emas
    // public $translatable = ['title']; // bu blade uchun




    public function searchableAs(): string
    {
        return 'posts_index';
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'description' => (string) $this->description,
        ];
    }



    //     public $translatable = ['field_name'];
    //     protected $appends = ['field_name_flat'];

    //     // ...

    //     public function getFieldNameFlatAttribute()
    //     {
    //         return json_encode($this->getTranslations('field_name'));
    //     }

    //     $index = $meilisearch->index('your_model_index');

    // YourModel::chunk(200, function ($models) use ($index) {
    //     $documents = [];

    //     foreach ($models as $model) {
    //         $documents[] = [
    //             'id' => $model->id,
    //             'field_name_flat' => $model->field_name_flat,
    //             // ... other fields
    //         ];
    //     }

    //     $index->addDocuments($documents);
    // });

}
