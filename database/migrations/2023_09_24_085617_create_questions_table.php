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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_code')->unique()->nullable();
            $table->string('question');
            $table->json('multiple_choice');
            $table->string('answer');
            $table->double('difficulty_level')->min(0.01)->max(1);
            $table->double('different_power')->min(0.01)->max(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
