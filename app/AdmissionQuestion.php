<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionQuestion extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'question',
    ];

    public function answers()
    {
        return $this->hasMany('App\AdmissionAnswer', 'admission_question_id', 'id');
    }
}
