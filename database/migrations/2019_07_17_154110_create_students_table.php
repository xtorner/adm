<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admission_id');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('language');
            $table->date('birth_date')->nullable();
            $table->string('origin_school')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('course_summer_makers_id')->nullable();
            $table->string('reference')->nullable()->unique();
            $table->date('enrollment_date')->nullable();
            $table->date('course_date')->nullable();
            $table->boolean('lunch_room');
            $table->text('observations')->nullable();

            $table->foreign('admission_id')->references('id')->on('admissions');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('course_summer_makers_id')->references('id')->on('course_summer_makers');

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
        Schema::dropIfExists('students');
        Schema::enableForeignKeyConstraints();
    }
}
