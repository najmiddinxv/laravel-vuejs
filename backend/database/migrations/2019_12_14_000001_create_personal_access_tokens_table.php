<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //==========================================================================
    //auth va refresh tokenlarni bitta qatorga saqlash uchun yozilgan migration
    //==========================================================================
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->timestamp('last_used_at')->nullable();
            $table->string('token', 64)->unique();
            $table->timestamp('expires_at')->nullable();
            $table->string('refresh_token', 64)->nullable()->unique(); //added row
            $table->timestamp('expires_at_refresh_token')->nullable();//added row
            $table->text('abilities')->nullable();
            $table->string('user_ip')->nullable();//added row
            $table->jsonb('user_location_info')->nullable();//added row
            $table->string('user_device_name',1000)->nullable();//added row
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
