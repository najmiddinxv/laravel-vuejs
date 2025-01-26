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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // $table->integer('contact_subject_id');
            $table->foreignId('contact_subject_id')
            ->nullable()
            ->constrained('contact_subjects')
            ->onUpdate('set null')
            ->onDelete('set null');

            $table->string('name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->text('body')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
