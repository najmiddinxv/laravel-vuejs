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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name')->nullable();//familya
            $table->string('first_name')->nullable();//ism
            $table->string('middle_name')->nullable();//sharif
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number',30)->unique()->nullable();
            $table->dateTime('phone_number_confirmed_at')->nullable();
            $table->tinyInteger('user_type')->default(2);
            $table->tinyInteger('status')->default(1);
            $table->jsonb('avatar')->nullable();
            $table->string('password')->nullable();
            // $table->string('telegram_full_name')->nullable();
            // $table->string('telegram_phone_number',30)->nullable();
            // $table->string('telegram_chat_id')->nullable();
            // $table->string('telegram_username')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
