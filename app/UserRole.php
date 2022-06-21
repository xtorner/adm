<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'name'
    ];

    public function hasRole($role)
    {
        $role = static::where('name',$role)->first();

        if ($role) {
            return true;
        }

        return false;
    }
}
