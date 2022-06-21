<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'admission_status_id',
        'language_id',
        'contact_date',
        'enrollment_date',
        'phone_one',
        'phone_one_desc',
        'phone_two',
        'phone_two_desc',
        'email_one',
        'email_one_desc',
        'email_two',
        'email_two_desc',
        'observations',
        'closed',
    ];

    protected $attributes = [
        'closed' => false,
    ];

    public function status()
    {
        return $this->belongsTo('App\AdmissionStatus', 'admission_status_id', 'id');
    }

    public function questionsAnswers()
    {
        return $this->hasMany('App\AdmissionQuestionAnswer');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

}
