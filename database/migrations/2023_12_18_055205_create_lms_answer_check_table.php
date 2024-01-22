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
        Schema::create('lms_answer_check', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('course_id')->nullable();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('lesson_id')->nullable();
            $table->json('question_ids');
            $table->json('user_answers');
            $table->integer('correct_answer');
            $table->integer('question_numbers');
            $table->string('foiz');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_answer_check');
    }
};
