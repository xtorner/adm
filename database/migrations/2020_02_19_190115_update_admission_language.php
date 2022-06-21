<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdmissionLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->unsignedInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('languages');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->dropIndex('admissions_language_id_foreign');
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('language_id');
        });
    }
}
