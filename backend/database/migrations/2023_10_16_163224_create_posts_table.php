<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->onUpdate('set null')
            ->onDelete('set null'); //default restirict action bo'ladi
            // $table->foreignId('category_id')->nullable()->constrained(); // nullable shunaqa yoziladi

            //category jadvalidagi birorta categoryni o'chirmoqchi bo'lsak error beradi yani o'chirishni cheklaydi. qachonki shu
            //category bog'langan postlarni o'chirib tashlasak keyin categoryni o'chirsa bo'ladi
            /**
             * restrict: Agar tegishli jadvalda tegishli yozuvlar mavjud bo'lsa, havola qilingan yozuvni yangilash yoki o'chirishni oldini oladi.
             * Bu shuni anglatadiki, agar siz havola qilingan jadvaldagi (categories) yozuvni yangilashga yoki o'chirishga harakat qilsangiz
             * va joriy (posts) jadvalda tegishli yozuvlar mavjud bo'lsa, harakat oldini oladi.
             * $table->foreignId('category_id')->constrained('categories')->onUpdate('restrict')->onDelete('restrict');
            **/

            //cascade bu degani category jadvalidagi birorta categoryni o'chirsak shu categoryga bog'langan postlar ham o'chib ketadi
            /**
             * cascade: havola qilingan yozuv yangilangan yoki o'chirilganda, tegishli jadvaldagi tegishli yozuvlar ham yangilanadi yoki o'chiriladi.
             * Bu shuni anglatadiki, agar siz havola qilingan jadvaldagi (categories) yozuvni yangilasangiz yoki o'chirsangiz,
             * joriy (posts) jadvaldagi barcha tegishli yozuvlar (bu erda category_id chet el kaliti) mos ravishda yangilanadi yoki o'chiriladi.
             * $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            **/

            //set null bu degani category jadvalidagi birorta categoryni o'chirsak shu categoryga bog'langan postlarga ya'ni category_id ga null yozib qo'yadi
            /**
             * set null: havola qilingan yozuv yangilangan yoki o'chirilganda, tegishli jadvaldagi tashqi kalit ustuni NULL ga o'rnatiladi.
             * Bu shuni anglatadiki, agar siz havola qilingan jadvaldagi (categories) yozuvni yangilasangiz yoki o'chirsangiz,
             * joriy (posts) jadvaldagi tegishli yozuvlardagi category_id ustuni NULLga o'rnatiladi.
             * $table->foreignId('category_id')->constrained('categories')->onUpdate('set null')->onDelete('set null');
            **/

            //no action bu ham restrict bilan bir xil
            /**
             *
             * Xulq-atvor nuqtai nazaridan, ON DELETE NO ACTION va ON DELETE RESRICT asosan bir xil.
             * Har ikkisi ham ota-jadvaldagi satrni o'chirishga yo'l qo'ymaydi,
             * agar bola jadvalida unga havola qiluvchi tegishli qatorlar mavjud bo'lsa. Shunday qilib,
             * agar jadvalingizda bog'langan yozuvlar mavjud bo'lsa, toifani o'chirishni oldini olishni istasangiz,
             * HARAKAT YO'Q yoki RESTRICT dan foydalanishingiz mumkin.
             * NO ACTION dan foydalanish uchun migratsiya kodingizni qanday o‘zgartirishingiz mumkin:
             * $table->foreignId('category_id')
                    ->nullable()
                    ->constrained('categories')
                    ->onUpdate('cascade')
                    ->onDelete('no action');

                ON DELETE NO ACTION va ON DELETE RESTRICT ikkalasi ham bir xil maqsadga xizmat qiladi:
                ular ota-jadvaldagi satrni o'chirishni oldini oladi, agar unga havola qiluvchi bolalar
                jadvalida tegishli qatorlar mavjud bo'lsa. Ularning orasidagi tanlov sizning xohishingizga
                va arizangizning o'ziga xos talablariga bog'liq. Ammo shuni ta'kidlash joizki,
                ON DELETE NO ACTION o'chirilgandan so'ng hech qanday harakatni avtomatik ravishda bajarmaslik
                niyati haqida aniqroq, ON DELETE RESTRICT esa o'chirish cheklanganligini aniq aytadi. Amalda,
                ba'zi ishlab chiquvchilar ON DELETE RESTRICT dan foydalanishni afzal ko'radilar,
                chunki u o'chirishni cheklash niyatini aniqroq bildiradi,
                boshqalari esa aniqligi uchun ON DELETE NO HARAKATni afzal ko'radi. Oxir-oqibat,
                ikkalasi ham bir xil natijaga erishadilar, shuning uchun qaror ko'pincha shaxsiy yoki
                jamoaviy imtiyozlarga asoslanadi.
             *
             *
             *
             * no action: havola qilingan yozuv yangilangan yoki o'chirilganda hech narsa qilmaydi.
             * Siz barcha kerakli harakatlarni qo'lda bajarish uchun javobgarsiz. Bu shuni anglatadiki,
             * agar siz havola qilingan jadvaldagi (categories) yozuvni yangilasangiz yoki o'chirsangiz,
             * joriy (posts) jadvaldagi tegishli yozuvlar bo'yicha avtomatik harakatlar amalga oshirilmaydi.
             * Ilova mantig'ida kerakli amallarni bajarish sizga bog'liq.
             * $table->foreignId('category_id')->constrained('categories')->onUpdate('no action')->onDelete('no action');
            **/

            $table->jsonb('title');
            $table->jsonb('slug');
            $table->jsonb('description')->nullable();
            $table->jsonb('body')->nullable();
            $table->jsonb('main_image')->nullable();
            // $table->jsonb('images')->nullable(); //postni body qismida slider image chiqarish uchun kerak
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('slider')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
