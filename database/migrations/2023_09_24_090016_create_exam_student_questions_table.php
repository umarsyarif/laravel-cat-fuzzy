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
        Schema::create('exam_student_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_student_id')->unsigned()->index();
            $table->bigInteger('question_id')->unsigned()->index();
            $table->string('answer')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();

            $table->foreign('exam_student_id')
                ->references('id')->on('exam_student')
                ->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_student_questions');
    }
};
