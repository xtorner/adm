<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\AnswerRequest;
use App\Repositories\Admission\AnswerRepository;
use App\Repositories\Admission\QuestionAnswerRepository;

class AnswerService
{
    protected $answer;
    protected $questionAnswer;

    public function __construct(
        AnswerRepository $answer,
        QuestionAnswerRepository $questionAnswer
    ){
        $this->answer = $answer;
        $this->questionAnswer = $questionAnswer;
    }

    public function list()
    {
        return $this->answer->all();
    }

    public function create(AnswerRequest $request)
    {
        $attributes = $request->all();

        return $this->answer->create($attributes);
    }

    public function read($id)
    {
        return $this->answer->find($id);
    }

    public function update(AnswerRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->answer->update($id, $attributes);
    }

    public function delete($id)
    {
        // Questions Answers
        if ($this->questionAnswer->exists([['admission_answer_id', '=', $id]])) {
            $this->questionAnswer->deleteWhere([['admission_answer_id', '=', $id]]);
        }

        return $this->answer->delete($id);
    }

    public function deleteWhere($where)
    {
        return $this->answer->deleteWhere($where);
    }

    public function exists($where)
    {
        return $this->answer->exists($where);
    }

}
