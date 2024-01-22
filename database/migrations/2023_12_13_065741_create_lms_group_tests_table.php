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
        Schema::create('lms_group_tests', function (Blueprint $table) {
            $table->id();
            $table->json('test_json');
            $table->string('level');
            $table->integer('ball')->nullable();
            $table->integer('limit')->nullable();
            $table->foreignId('lesson_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_group_tests');
    }
};
