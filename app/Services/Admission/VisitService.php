<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\VisitRequest;
use App\Repositories\Admission\VisitRepository;

class VisitService
{
    protected $visit;

    public function __construct(VisitRepository $visit)
    {
        $this->visit = $visit;
    }

    public function list($id)
    {
        return $this->visit->all($id);
    }

    public function create(VisitRequest $request)
    {
        $attributes = $request->all();

        if(isset($attributes['date'])) {
            $date = date_create_from_format('d/m/Y H:i', $attributes['date']);
            $attributes['date'] = $date;
        }

        return $this->visit->create($attributes);
    }

    public function read($id)
    {
        return $this->visit->find($id);
    }

    public function findLatest($admission)
    {
        return $this->visit->findLatest($admission->id);
    }

    public function update(VisitRequest $request, $id)
    {
        $attributes = $request->all();

        if(isset($attributes['date'])) {
            $date = date_create_from_format('d/m/Y H:i', $attributes['date']);
            $attributes['date'] = $date;
        }

        return $this->visit->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->visit->delete($id);
    }

    public function deleteWhere($where)
    {
        return $this->visit->deleteWhere($where);
    }

    public function exists($where)
    {
        return $this->visit->exists($where);
    }
}
