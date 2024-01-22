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
        Schema::create('lms_tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('variant_a')->nullable();
            $table->string('variant_b')->nullable();
            $table->string('variant_c')->nullable();
            $table->string('variant_d')->nullable();
            $table->string('answer');
            $table->foreignId('lesson_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_tests');
    }
};
