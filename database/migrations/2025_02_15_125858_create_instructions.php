<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('file')->nullable(false);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_moderation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
