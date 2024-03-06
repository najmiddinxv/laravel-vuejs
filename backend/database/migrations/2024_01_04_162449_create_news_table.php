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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('no action');
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status');
            $table->boolean('slider')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
        Schema::create('news_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->string('description',500)->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();

            $table->unique(['news_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_translations');
    }
};
