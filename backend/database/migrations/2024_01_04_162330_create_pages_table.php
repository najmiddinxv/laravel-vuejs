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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            // $table->integer('category_id')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('no action');
            $table->jsonb('title');
            $table->jsonb('slug');
            $table->jsonb('description')->nullable();
            $table->jsonb('body')->nullable();
            $table->jsonb('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('view_count')->default(0);
            $table->boolean('slider')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
