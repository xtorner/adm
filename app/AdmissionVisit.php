<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionVisit extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'admission_id',
        'date',
        'observations',
    ];

}
