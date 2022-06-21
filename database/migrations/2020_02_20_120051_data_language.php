<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Admission;
use App\Student;
use App\Language;

class DataLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Admissions
        $admissions = Admission::all();
        foreach($admissions as $admission) {

            if($admission->language === 'ca') {
                $language = Language::where('name', '=', 'Català')->first();
                $admission->update(['language_id' => $language->id]);
            }

            if($admission->language === 'es') {
                $language = Language::where('name', '=', 'Castellà')->first();
                $admission->update(['language_id' => $language->id]);
            }

            if($admission->language === 'en') {
                $language = Language::where('name', '=', 'Anglès')->first();
                $admission->update(['language_id' => $language->id]);
            }

        }

        // Students
        $students = Student::all();
        foreach($students as $student) {

            if($student->language === 'ca') {
                $language = Language::where('name', '=', 'Català')->first();
                $student->update(['language_id' => $language->id]);
            }

            if($student->language === 'es') {
                $language = Language::where('name', '=', 'Castellà')->first();
                $student->update(['language_id' => $language->id]);
            }

            if($student->language === 'en') {
                $language = Language::where('name', '=', 'Anglès')->first();
                $student->update(['language_id' => $language->id]);
            }

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Admissions
        $admissions = Admission::all();
        foreach($admissions as $admission) {
            $admission->update(['language_id' => NULL]);
        }

        // Admissions
        $students = Student::all();
        foreach($students as $student) {
            $student->update(['language_id' => NULL]);
        }


    }
}
