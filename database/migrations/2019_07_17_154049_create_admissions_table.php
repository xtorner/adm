<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admission_status_id');
            $table->string('name');
            $table->string('language')->nullable();
            $table->date('contact_date');
            $table->date('enrollment_date')->nullable();
            $table->integer('phone_one')->nullable();
            $table->string('phone_one_desc')->nullable();
            $table->integer('phone_two')->nullable();
            $table->string('phone_two_desc')->nullable();
            $table->string('email_one')->nullable();
            $table->string('email_one_desc')->nullable();
            $table->string('email_two')->nullable();
            $table->string('email_two_desc')->nullable();
            $table->text('observations')->nullable();
            $table->boolean('closed');

            $table->foreign('admission_status_id')->references('id')->on('admission_statuses');

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
        Schema::dropIfExists('admissions');
        Schema::enableForeignKeyConstraints();
    }
}
