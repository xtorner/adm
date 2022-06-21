<?php
namespace App\Services\School;

use App\Http\Requests\School\SchoolRequest;
use App\Repositories\School\SchoolRepository;

class SchoolService
{
    protected $school;

    public function __construct(SchoolRepository $school)
    {
        $this->school = $school;
    }

    public function list()
    {
        return $this->school->all();
    }

    public function create(SchoolRequest $request)
    {
        $attributes = $request->all();

        return $this->school->create($attributes);
    }

    public function read($id)
    {
        return $this->school->find($id);
    }

    public function update(SchoolRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->school->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->school->delete($id);
    }

}
