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
        Schema::create('contact_subjects', function (Blueprint $table) {
            $table->id();

            // $table->json('name');
            // The json type is used to store JSON data as a plain text string in the database.
            // It provides a simple way to store and retrieve JSON data, but it doesn't offer advanced indexing or querying capabilities specific to the JSON structure.

            $table->jsonb('name');
            // The jsonb type (binary JSON) is used to store JSON data in a more efficient binary format. It supports indexing and querying operations on the JSON data.
            // While json stores data as plain text, jsonb parses and stores the JSON data in a more structured way, allowing for faster and more complex queries.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_subjects');
    }
};
