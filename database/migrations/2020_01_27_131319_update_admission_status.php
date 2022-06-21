<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdmissionStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admission_statuses')
            ->where(
                'name',
                '=',
                'Matriculació tancada'
            )->update([
                'name' =>'No matrícula'
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admission_statuses')
            ->where(
                'name',
                '=',
                'No matrícula'
            )->update([
                'name' => 'Matriculació tancada',
            ]);
    }
}
