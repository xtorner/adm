<?php

namespace App\Repositories\Admission;

use App\AdmissionVisit;

class VisitRepository
{
    protected $visit;

    public function __construct(AdmissionVisit $visit)
    {
        $this->visit = $visit;
    }

    public function create($attributes)
    {
        return $this->visit::create($attributes);
    }

    public function all($id)
    {
        return $this->visit::all()->where('admission_id', $id);
    }

    public function find($id)
    {
        return $this->visit::find($id);
    }

    public function findLatest($id)
    {
        return $this->visit->where('admission_id','=', $id)->latest('date')->first();
    }

    public function update($id, array $attributes)
    {
        return $this->visit::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->visit::find($id)->delete();
    }

    public function deleteWhere($where)
    {
        return $this->visit::where($where)->delete();
    }

    public function exists($where)
    {
        return $this->visit->where($where)->exists();
    }
}
