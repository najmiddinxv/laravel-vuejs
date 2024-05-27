<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained(
                    table:'categories',
                    column:'id',
                    indexName:'images_category_id'
                )->onUpdate('set null')
                ->onDelete('set null');

            // $table->foreignId('category_id')->constrained(
            //     table: 'categories', indexName: 'posts_category_id'
            // )->onUpdate('cascade')->onDelete('cascade');

            // 2 ta jadval bor: author va book (author_id)
            // Relation hosil qilganizda:
            // - restrict qilsangiz authorni o'chirib bo'lmaydi qachonki unga tegishli book larni o'chirmagunizcha.
            // - set null qilsangiz author_id o'rniga null yozib qo'yadi author o'chirilganda.
            // - cascade bo'lsa author o'chirilganda unga tegishli book lar ham o'chib ketadi.
            // - no action qilsangiz author_id o'zgarmay o'z o'rnida qoladi author o'chirilganda.
            // default restirict oladi

            $table->jsonb('name');
            $table->string('path');
            $table->string('mime_type', 50)->nullable();
            $table->unsignedBigInteger('size');
            // $table->unsignedInteger('download_count')->default(0);
            $table->unsignedBigInteger('uploaded_by');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
