<?php

namespace App\Repositories\Information;

use App\InformationCourse;

class CourseRepository
{
    protected $course;

    public function __construct(InformationCourse $course)
    {
        $this->course = $course;
    }

    public function create($attributes)
    {
        return $this->course::create($attributes);
    }

    public function all($sortBy = [])
    {
        return $this->course::all()->sortByDesc($sortBy);
    }

    public function find($id)
    {
        return $this->course->find($id);
    }

    public function findWhere($where)
    {
        return $this->course->where([$where])->first();
    }

    public function update($id, array $attributes)
    {
        return $this->course->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->course->find($id)->delete();
    }

    public function updateAll($where, $attributes)
    {
        return $this->course->where([$where])->update($attributes);
    }
}
