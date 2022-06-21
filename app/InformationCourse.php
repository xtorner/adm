<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationCourse extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'year',
        'date_start',
        'date_preins',
        'date_preins_end',
        'date_end',
        'date_admission',
        'date_admission_end',
        'active',
    ];

    protected $attributes = [
        'active' => true,
    ];
}
