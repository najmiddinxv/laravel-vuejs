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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')
                ->constrained(
                    table:'albums',
                    column:'id',
                    indexName:'images_album_id'
                )->onDelete('cascade')
                ->onUpdate('cascade');

            // $table->foreignId('category_id')->constrained(
            //     table: 'categories', indexName: 'posts_category_id'
            // )->onUpdate('cascade')->onDelete('cascade');

            // 2 ta jadval bor: author va book (author_id)
            // Relation hosil qilganizda:
            // - restrict qilsangiz authorni o'chirib bo'lmaydi qachonki unga tegishli book larni o'chirmagunizcha.
            // - set null qilsangiz author_id o'rniga null yozib qo'yadi author o'chirilganda.
            // - cascade bo'lsa author o'chirilganda unga tegishli book lar ham o'chib ketadi.


            $table->jsonb('name');
            $table->jsonb('slug');
            $table->jsonb('description')->nullable();
            $table->string('image')->nullable();
            $table->string('ext', 50)->nullable();
            $table->double('size')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
