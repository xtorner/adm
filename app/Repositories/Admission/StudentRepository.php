<?php

namespace App\Repositories\Admission;

use App\Student;

class StudentRepository
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function create($attributes)
    {
        return $this->student::create($attributes);
    }

    public function all($id)
    {
        return $this->student::all()->where('admission_id', $id);
    }

    public function find($id)
    {
        return $this->student::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->student::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->student::find($id)->delete();
    }

    public function deleteWhere($where)
    {
        return $this->student::where($where)->delete();
    }

    public function exists($where)
    {
        return $this->student::where($where)->exists();
    }
}
