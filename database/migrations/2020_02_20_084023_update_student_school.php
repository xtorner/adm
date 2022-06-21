<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudentSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedInteger('origin_school_id')->nullable();
            $table->foreign('origin_school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['origin_school_id']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex('students_origin_school_id_foreign');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('origin_school_id');
        });

    }
}
