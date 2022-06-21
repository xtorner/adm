<?php

namespace App\Repositories\School;

use App\School;

class SchoolRepository
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function create($attributes)
    {
        return $this->school::create($attributes);
    }

    public function all()
    {
        return $this->school::all();
    }

    public function find($id)
    {
        return $this->school::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->school::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->school::find($id)->delete();
    }
}
