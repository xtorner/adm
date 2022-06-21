<?php

namespace App\Repositories\Course;

use App\CourseSummerMaker;

class SummerMakerRepository
{
    protected $summerMaker;

    public function __construct(CourseSummerMaker $summerMaker)
    {
        $this->summerMaker = $summerMaker;
    }

    public function create($attributes)
    {
        return $this->summerMaker::create($attributes);
    }

    public function all()
    {
        return $this->summerMaker::all();
    }

    public function find($id)
    {
        return $this->summerMaker::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->summerMaker::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->summerMaker::find($id)->delete();
    }
}
