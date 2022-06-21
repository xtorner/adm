<?php

namespace App\Repositories\Admission;

use App\AdmissionQuestionAnswer;

class QuestionAnswerRepository
{
    protected $questionAnswer;

    public function __construct(AdmissionQuestionAnswer $questionAnswer)
    {
        $this->questionAnswer = $questionAnswer;
    }

    public function create($attributes)
    {
        return $this->questionAnswer::create($attributes);
    }

    public function all()
    {
        return $this->questionAnswer::all();
    }

    public function find($id)
    {
        return $this->questionAnswer::find($id);
    }

    public function exists($where)
    {
        return $this->questionAnswer->where($where)->exists();
    }

    public function update($id, array $attributes)
    {
        return $this->questionAnswer::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->questionAnswer::find($id)->delete();
    }

    public function deleteWhere($where)
    {
        return $this->questionAnswer::where($where)->delete();
    }
}
