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
        Schema::create('lms_passed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('lesson_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('limit')->nullable();
            $table->integer('pass_status')->nullable();
            $table->json('answer_check_id')->nullable();
            $table->integer('limit_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_passed');
    }
};
