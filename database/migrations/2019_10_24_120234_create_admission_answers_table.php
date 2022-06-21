<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('admission_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admission_question_id');
            $table->string('answer');

            $table->foreign('admission_question_id')->references('id')->on('admission_questions');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('admission_answers');
        Schema::enableForeignKeyConstraints();
    }
}
