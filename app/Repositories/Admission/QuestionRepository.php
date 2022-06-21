<?php

namespace App\Repositories\Admission;

use App\AdmissionQuestion;

class QuestionRepository
{
    protected $question;

    public function __construct(AdmissionQuestion $question)
    {
        $this->question = $question;
    }

    public function create($attributes)
    {
        return $this->question::create($attributes);
    }

    public function all()
    {
        return $this->question::all();
    }

    public function find($id)
    {
        return $this->question::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->question::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->question::find($id)->delete();
    }
}
