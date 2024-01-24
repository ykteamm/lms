<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeFoizColumnTypeInLmsAnswerCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE lms_answer_check ALTER COLUMN foiz TYPE INTEGER USING foiz::integer');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE lms_answer_check ALTER COLUMN foiz TYPE VARCHAR(255)');
    }
}
