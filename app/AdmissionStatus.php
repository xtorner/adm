<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionStatus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

}
