<?php
namespace App\Services\Information;

use App\Http\Requests\Information\CourseRequest;
use App\Repositories\Information\CourseRepository;

class CourseService
{
    protected $course;

    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
    }

    public function list()
    {
        return $this->course->all("year");
    }

    public function create(CourseRequest $request)
    {
        $attributes = $request->all();

        if(isset($attributes['date_preins'])) {
            $attributes['date_preins'] = date('Y-m-d', strtotime($attributes['date_preins']));
        }

        if(isset($attributes['date_preins_end'])) {
            $attributes['date_preins_end'] = date('Y-m-d', strtotime($attributes['date_preins_end']));
        }

        if(isset($attributes['date_start'])) {
            $attributes['date_start'] = date('Y-m-d', strtotime($attributes['date_start']));
        }

        if(isset($attributes['date_end'])) {
            $attributes['date_end'] = date('Y-m-d', strtotime($attributes['date_end']));
        }

        if(isset($attributes['date_admission'])) {
            $attributes['date_admission'] = date('Y-m-d', strtotime($attributes['date_admission']));
        }

        if(isset($attributes['date_admission_end'])) {
            $attributes['date_admission_end'] = date('Y-m-d', strtotime($attributes['date_admission_end']));
        }

        if (!$request->has('active')) {
            $attributes['active'] = 0;
        } else {
            $this->disableAll();
        }

        return $this->course->create($attributes);
    }

    public function read($id)
    {
        return $this->course->find($id);
    }

    public function update(CourseRequest $request, $id)
    {
        $attributes = $request->all();

        if(isset($attributes['date_preins'])) {
            $attributes['date_preins'] = date('Y-m-d', strtotime($attributes['date_preins']));
        }

        if(isset($attributes['date_preins_end'])) {
            $attributes['date_preins_end'] = date('Y-m-d', strtotime($attributes['date_preins_end']));
        }

        if(isset($attributes['date_start'])) {
            $attributes['date_start'] = date('Y-m-d', strtotime($attributes['date_start']));
        }

        if(isset($attributes['date_end'])) {
            $attributes['date_end'] = date('Y-m-d', strtotime($attributes['date_end']));
        }

        if(isset($attributes['date_admission'])) {
            $attributes['date_admission'] = date('Y-m-d', strtotime($attributes['date_admission']));
        }

        if(isset($attributes['date_admission_end'])) {
            $attributes['date_admission_end'] = date('Y-m-d', strtotime($attributes['date_admission_end']));
        }

        if (!$request->has('active')) {
            $attributes['active'] = 0;
        } else {
            $this->disableAll();
        }

        return $this->course->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->course->delete($id);
    }

    public function disableAll()
    {
        return $this->course->updateAll(['active','=', '1'], ['active'=>0]);
    }

    public function getActive()
    {
        return $this->course->findWhere(['active', '=', '1']);
    }

    public function getTrimester($mes=null)
    {
        $mes = is_null($mes) ? date('m') : $mes;
        return floor(($mes-1) / 3)+1;
    }

}
