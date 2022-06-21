<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\StatusRequest;
use App\Repositories\Admission\StatusRepository;

class StatusService
{
    protected $status;

    public function __construct(StatusRepository $status)
    {
        $this->status = $status;
    }

    public function list()
    {
        return $this->status->all();
    }

    public function create(StatusRequest $request)
    {
        $attributes = $request->all();

        return $this->status->create($attributes);
    }

    public function read($id)
    {
        return $this->status->find($id);
    }

    public function findStatus($status)
    {
        return $this->status->findWhere(['name', '=', $status]);
    }

    public function update(StatusRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->status->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->status->delete($id);
    }

}
