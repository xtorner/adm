<?php

namespace App\Repositories\Admission;

use App\AdmissionStatus;

class StatusRepository
{
    protected $status;

    public function __construct(AdmissionStatus $status)
    {
        $this->status = $status;
    }

    public function create($attributes)
    {
        return $this->status::create($attributes);
    }

    public function all()
    {
        return $this->status::all();
    }

    public function find($id)
    {
        return $this->status::find($id);
    }

    public function findWhere($where)
    {
        return $this->status->where([$where])->first();
    }

    public function update($id, array $attributes)
    {
        return $this->status::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->status::find($id)->delete();
    }
}
