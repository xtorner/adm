<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteLanguageOriginSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('language');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['language', 'origin_school']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->string('language')->nullable();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->string('language');
        });
    }
}
