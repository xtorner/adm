<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInformationCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('information_courses', function (Blueprint $table) {
            $table->date('date_admission')->nullable();
        });
        Schema::table('information_courses', function (Blueprint $table) {
            $table->date('date_admission_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('information_courses', function (Blueprint $table) {
            $table->dropColumn('date_admission');
        });
        Schema::table('information_courses', function (Blueprint $table) {
            $table->dropColumn('date_admission_end');
        });
    }
}
