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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // FOREIGN KEYS
            $table->foreignId('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('level_id');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->foreignId('sentimental_id')->nullable();
            $table->foreign('sentimental_id')->references('id')->on('sentimentals');

            $table->foreignId('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->date('day_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_header')->nullable();
            $table->string('image_header_url')->nullable();
            $table->string('title')->nullable();
            $table->string('bio')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('public_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
