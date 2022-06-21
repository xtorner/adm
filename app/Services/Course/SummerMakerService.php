<?php
namespace App\Services\Course;

use App\Http\Requests\Course\SummerMakerRequest;
use App\Repositories\Course\SummerMakerRepository;

class SummerMakerService
{
    protected $summerMaker;

    public function __construct(SummerMakerRepository $summerMaker)
    {
        $this->summerMaker = $summerMaker;
    }

    public function list()
    {
        return $this->summerMaker->all();
    }

    public function create(SummerMakerRequest $request)
    {
        $attributes = $request->all();

        return $this->summerMaker->create($attributes);
    }

    public function read($id)
    {
        return $this->summerMaker->find($id);
    }

    public function update(SummerMakerRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->summerMaker->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->summerMaker->delete($id);
    }

}
