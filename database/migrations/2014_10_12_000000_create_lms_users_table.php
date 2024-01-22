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
        Schema::create('lms_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->foreignId('region_id');
            $table->foreignId('district_id');
            $table->string('phone')->unique();
            $table->string('image',50);
            $table->string('passport_image',50);
            $table->integer('status')->default(0);
            $table->string('rol_id')->default('user');
            $table->string('username')->unique();
            $table->string('password');
            $table->dateTime('date_joined')->nullable();
            $table->dateTime('date_register')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lms_users');
    }
};
