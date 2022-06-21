<?php

namespace App\Repositories\Admission;

use App\Admission;

class AdmissionRepository
{
    protected $admission;

    public function __construct(Admission $admission)
    {
        $this->admission = $admission;
    }

    public function exists($where)
    {
        return $this->admission->where($where)->exists();
    }

    public function create($attributes)
    {
        return $this->admission::create($attributes);
    }

    public function all()
    {
        return $this->admission::all();
    }

    public function find($id)
    {
        return $this->admission::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->admission::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->admission::find($id)->delete();
    }
}
