<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsOraliqTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_oraliq_test', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->json('question_ids');
            $table->json('user_answers');
            $table->integer('correct_answer');
            $table->integer('question_numbers');
            $table->integer('ball');
            $table->integer('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_oraliq_test');
    }
}
