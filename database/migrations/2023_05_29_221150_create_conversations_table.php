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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->string('slug')->unique();
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('receptor_id')->constrained('users');

            $table->unique(['sender_id', 'receptor_id']);
            $table->unique(['receptor_id', 'sender_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
