<?php

namespace App\Repositories\Admission;

use App\AdmissionAnswer;

class AnswerRepository
{
    protected $answer;

    public function __construct(AdmissionAnswer $answer)
    {
        $this->answer = $answer;
    }

    public function create($attributes)
    {
        return $this->answer::create($attributes);
    }

    public function all()
    {
        return $this->answer::all();
    }

    public function find($id)
    {
        return $this->answer::find($id);
    }

    public function exists($where)
    {
        return $this->answer->where($where)->exists();
    }

    public function update($id, array $attributes)
    {
        return $this->answer::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->answer::find($id)->delete();
    }

    public function deleteWhere($where)
    {
        return $this->answer::where($where)->delete();
    }
}
