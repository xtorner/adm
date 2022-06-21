<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'admission_id',
        'course_id',
        'course_summer_makers_id',
        'name',
        'lastname',
        'language_id',
        'birth_date',
        'origin_school_id',
        'reference',
        'enrollment_date',
        'course_date',
        'lunch_room',
        'observations',
    ];

    protected $attributes = [
        'lunch_room' => false,
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function summerMaker()
    {
        return $this->belongsTo('App\CourseSummerMaker', 'course_summer_makers_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public function originSchool()
    {
        return $this->belongsTo('App\School', 'origin_school_id', 'id');
    }
}
