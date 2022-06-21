<?php
namespace App\Services\Course;

use App\Http\Requests\Course\CourseRequest;
use App\Repositories\Course\CourseRepository;

class CourseService
{
    protected $course;

    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
    }

    public function list()
    {
        return $this->course->all();
    }

    public function create(CourseRequest $request)
    {
        $attributes = $request->all();

        return $this->course->create($attributes);
    }

    public function read($id)
    {
        return $this->course->find($id);
    }

    public function update(CourseRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->course->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->course->delete($id);
    }

}
