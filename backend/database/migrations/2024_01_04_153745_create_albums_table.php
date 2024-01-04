<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->json('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('albums_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->string('name', 255);
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('locale')->index();
            $table->unique(['id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
        Schema::dropIfExists('albums_translations');
    }
};
