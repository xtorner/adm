<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\StudentRequest;
use App\Repositories\Admission\StudentRepository;

class StudentService
{
    protected $student;

    public function __construct(StudentRepository $student)
    {
        $this->student = $student;
    }

    public function list($id)
    {
        return $this->student->all($id);
    }

    public function create(StudentRequest $request)
    {
        $attributes = $request->all();

        if(isset($attributes['birth_date'])) {
            $attributes['birth_date'] = date('Y-m-d', strtotime($attributes['birth_date']));
        }

        if(isset($attributes['enrollment_date'])) {
            $attributes['enrollment_date'] = date('Y-m-d', strtotime($attributes['enrollment_date']));
        }

        if(isset($attributes['course_date'])) {
            $attributes['course_date'] = date('Y-m-d', strtotime($attributes['course_date']));
        }

        if (!$request->has('lunch_room')) {
            $attributes['lunch_room'] = 0;
        }

        return $this->student->create($attributes);
    }

    public function read($id)
    {
        return $this->student->find($id);
    }

    public function update(StudentRequest $request, $id)
    {
        $attributes = $request->all();

        if(isset($attributes['birth_date'])) {
            $attributes['birth_date'] = date('Y-m-d', strtotime($attributes['birth_date']));
        }

        if(isset($attributes['course_date'])) {
            $attributes['course_date'] = date('Y-m-d', strtotime($attributes['course_date']));
        }

        if (!$request->has('lunch_room')) {
            $attributes['lunch_room'] = 0;
        }

        return $this->student->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->student->delete($id);
    }

    public function deleteWhere($where)
    {
        return $this->student->deleteWhere($where);
    }

    public function exists($where)
    {
        return $this->student->exists($where);
    }

}
