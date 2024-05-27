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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onUpdate('set null')
                ->onDelete('set null');
            $table->jsonb('title');
            $table->jsonb('slug');
            $table->jsonb('description')->nullable();
            $table->string('hls_path')->nullable();
            $table->string('original_path')->nullable();
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->jsonb('thumbnail')->nullable();
            $table->integer('view_count')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            $table->string('status')->default(1);
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
