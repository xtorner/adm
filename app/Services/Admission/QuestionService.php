<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\QuestionRequest;
use App\Repositories\Admission\QuestionAnswerRepository;
use App\Repositories\Admission\QuestionRepository;

class QuestionService
{
    protected $question;
    protected $questionAnswer;
    protected $answerService;

    public function __construct(
        QuestionRepository $question,
        QuestionAnswerRepository $questionAnswer,
        AnswerService $answerService
    ){
        $this->question = $question;
        $this->questionAnswer = $questionAnswer;
        $this->answerService = $answerService;
    }

    public function list()
    {
        return $this->question->all();
    }

    public function create(QuestionRequest $request)
    {
        $attributes = $request->all();

        return $this->question->create($attributes);
    }

    public function read($id)
    {
        return $this->question->find($id);
    }

    public function update(QuestionRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->question->update($id, $attributes);
    }

    public function delete($id)
    {
        // Questions Answers
        if ($this->questionAnswer->exists([['admission_question_id', '=', $id]])) {
            $this->questionAnswer->deleteWhere([['admission_question_id', '=', $id]]);
        }

        // Answers
        if ($this->answerService->exists([['admission_question_id', '=', $id]])) {
            $this->answerService->deleteWhere([['admission_question_id', '=', $id]]);
        }

        return $this->question->delete($id);
    }

}
