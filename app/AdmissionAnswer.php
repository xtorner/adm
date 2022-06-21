<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionAnswer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'admission_question_id',
        'answer',
    ];

    public function question()
    {
        return $this->belongsTo('App\AdmissionQuestion');
    }
}
