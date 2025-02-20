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
        Schema::create('complaints__instructions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('dexription')->nullable(false);
            $table->boolean('status')->default(false);
            $table->foreignId('users_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('instructions_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints__instructions');
    }
};
