<?php

namespace App\Repositories\Course;

use App\Course;

class CourseRepository
{
    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function create($attributes)
    {
        return $this->course::create($attributes);
    }

    public function all()
    {
        return $this->course::all();
    }

    public function find($id)
    {
        return $this->course::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->course::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->course::find($id)->delete();
    }
}
