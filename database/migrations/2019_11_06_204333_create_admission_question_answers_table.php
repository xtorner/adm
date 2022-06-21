<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('admission_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admission_id');
            $table->unsignedInteger('admission_question_id');
            $table->unsignedInteger('admission_answer_id');

            $table->foreign('admission_id')->references('id')->on('admissions');
            $table->foreign('admission_question_id')->references('id')->on('admission_questions');
            $table->foreign('admission_answer_id')->references('id')->on('admission_answers');
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
        Schema::dropIfExists('admission_question_answers');
        Schema::enableForeignKeyConstraints();
    }
}
