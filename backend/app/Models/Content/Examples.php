<?php


class Examples{

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

    // protected function title(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => $this->getTranslatedAttribute($value),
    //         // set: fn (string $value) => strtolower($value),
    //     );
    // }

    // public function getBodyAttribute($value)
    // {
    //     return $this->getTranslatedAttribute($value);
    // }


    // agar yuqoridagi app/traits/TranslatableJson.php va app/traits/TranslateMethods.php
    // fayllardan foydalansak
    // https://spatie.be/docs/laravel-translatable/v6/introduction
    // bundan foydalanishimiz shart emas
    // public $translatable = ['title']; // bu blade uchun


    // public function searchableAs(): string
    // {
    //     return 'posts_index';
    // }

    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => (int) $this->id,
    //         'title' => $this->title,
    //         'description' => (string) $this->description,
    //     ];
    // }

    // public $translatable = ['title'];

    // protected $appends = ['title_flat'];

    // public function getTitlePostAttribute()
    // {
    //     return json_encode($this->title);
    // }





    //Category.php =====================================================
            // public function descendants()
            // {
            //     return $this->children()->with('descendants');
            // }

            //=============================translate===================================
            //translate uchun
            public $translatable = ['name']; // bu web uchun

            // bu esa api translate uchun
            // use App\Traits\TranslateMethods; shu yerdan olib tarjima qilayapti
            // {"uz":"Sport yangiliklari","ru":"Спортивные новости","en":"Sports news"}
            // bazada shu tartibda saqlanaypti
            //postmanda headerdan Accept-Language:uz qilib jonatilayapti

            //  public function getNameAttribute($value)
            //  {
            //      return $this->getTranslatedAttribute($value);
            //  }
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


            //attributs
            //  public function getTestAttribute()
            //  {
            //      return 'bu test append va shu category nomi : '. $this->name;
            //  }

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






            //  public $translatedAttributes = ['name', 'slug', 'description'];

            //  protected $fillable = [
            //      'image',
            //      'status',
            //  ];



        //     use App\Models\YourModel;

        // public function show($id)
        // {
        //     $post = YourModel::findOrFail($id);

        //     // Access translated attributes
        //     $title = $post->translate('en')->title;
        //     $secondTitle = $post->translate('en')->second_title;
        //     // ... and so on

        //     return view('posts.show', compact('post', 'title', 'secondTitle'));
        // }
        // Save to grepper
        // Step 5: CRUD Operations
        // You can create, update, and delete translatable models as you would with regular Eloquent models:

        // php
        // Copy code
        // use App\Models\YourModel;

        // // Create
        // $post = YourModel::create([
        //     'image' => 'example.jpg',
        //     'title' => ['en' => 'English Title', 'uz' => 'Uzbek Title'],
        //     // ... other translatable attributes
        // ]);

        // // Update
        // $post->update([
        //     'title' => ['en' => 'New English Title', 'uz' => 'New Uzbek Title'],
        //     // ... other translatable attributes
        // ]);

        // // Delete
        // $post->delete();
   //Category.php =====================================================





}
