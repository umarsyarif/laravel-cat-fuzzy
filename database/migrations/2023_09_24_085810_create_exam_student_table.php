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
        Schema::create('exam_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned()->index();
            $table->bigInteger('exam_id')->unsigned()->index();
            $table->double('final_score')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('exam_id')
                ->references('id')->on('exams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_student');
    }
};
