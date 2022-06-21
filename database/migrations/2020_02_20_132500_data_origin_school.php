<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Student;
use App\School;

class DataOriginSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Students
        $students = Student::all();
        foreach($students as $student) {
            if ($student->origin_school) {
                $school = School::create(['name'=>$student->origin_school]);
                $student->update(['origin_school_id'=>$school->id]);
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
        // Students
        $students = Student::all();
        foreach($students as $student) {
            $student->update(['origin_school_id' => NULL]);
        }

        // Schools
        $schools = School::all();
        foreach($schools as $school) {
            $school->forceDelete();
        }
    }
}
