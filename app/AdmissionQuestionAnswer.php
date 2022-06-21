<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionQuestionAnswer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'admission_id',
        'admission_question_id',
        'admission_answer_id',
    ];

}
