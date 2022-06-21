<?php
namespace App\Services\Admission;

use App\Http\Requests\Admission\AdmissionRequest;
use App\Repositories\Admission\AdmissionRepository;
use App\Repositories\Admission\QuestionAnswerRepository;

class AdmissionService
{
    protected $admission;
    protected $questionAnswer;

    protected $statusService;
    protected $questionService;
    protected $visitService;
    protected $studentService;

    public function __construct(
        AdmissionRepository $admission,
        QuestionAnswerRepository $questionAnswer,
        StatusService $statusService,
        QuestionService $questionService,
        VisitService $visitService,
        StudentService $studentService
    ){
        $this->admission = $admission;
        $this->questionAnswer = $questionAnswer;

        $this->statusService = $statusService;
        $this->questionService = $questionService;
        $this->visitService = $visitService;
        $this->studentService = $studentService;
    }

    public function list()
    {
        return $this->admission->all();
    }

    public function check(AdmissionRequest $request)
    {
        $attributes = $request->all();

        if ($this->admission->exists([['name', '=', $attributes['name']]])) {
            return true;
        } else {
            return false;
        }
    }

    public function create(AdmissionRequest $request)
    {
        $attributes = $request->all();

        if(isset($attributes['contact_date'])) {
            $attributes['contact_date'] = date('Y-m-d', strtotime($attributes['contact_date']));
        }

        $status = $this->statusService->findStatus('Pendent programar');

        $attributes['admission_status_id'] = $status->id;

        return $this->admission->create($attributes);
    }

    public function read($id)
    {
        return $this->admission->find($id);
    }

    public function update(AdmissionRequest $request, $id)
    {
        $attributes = $request->all();

        if(isset($attributes['contact_date'])) {
            $attributes['contact_date'] = date('Y-m-d', strtotime($attributes['contact_date']));
        }

        if(isset($attributes['enrollment_date'])) {
            $attributes['enrollment_date'] = date('Y-m-d', strtotime($attributes['enrollment_date']));
        }

        if (!$request->has('closed')) {
            $attributes['closed'] = 0;
        }

        $questions = $this->questionService->list();

        foreach($questions as $question) {
            $this->deleteQuestionAnswers($id, $question->id);
            $answer = $attributes['question_'.$question->id];
            if (isset($answer)) {
                $qa = [
                    'admission_id' => $id,
                    'admission_question_id' => $question->id,
                    'admission_answer_id' => $attributes['question_'.$question->id]
                ];
                $this->questionAnswer->create($qa);
            }
        }

        return $this->admission->update($id, $attributes);
    }

    public function delete($id)
    {
        // Questions
        if ($this->questionAnswer->exists([['admission_id', '=', $id]])) {
            $this->questionAnswer->deleteWhere([['admission_id', '=', $id]]);
        }

        // Students
        if ($this->studentService->exists([['admission_id', '=', $id]])) {
            $this->studentService->deleteWhere([['admission_id', '=', $id]]);
        }

        // Visits
        if ($this->visitService->exists([['admission_id', '=', $id]])) {
            $this->visitService->deleteWhere([['admission_id', '=', $id]]);
        }

        return $this->admission->delete($id);
    }

    public function isQuestionAnswer($admission, $question, $answer)
    {
        return $this->questionAnswer->exists([
            ['admission_id', '=', $admission],
            ['admission_question_id', '=', $question],
            ['admission_answer_id', '=', $answer],
        ]);
    }

    public function deleteQuestionAnswers($admission, $question)
    {
        return $this->questionAnswer->deleteWhere([
            ['admission_id', '=', $admission],
            ['admission_question_id', '=', $question],
        ]);
    }

    public function checkAndUpdateStatus($admission)
    {
        $visit = $this->visitService->findLatest($admission);
        $status = $this->statusService->findStatus('Pendent programar');

        // Check visits
        if (isset($visit)) {

            $now = new \DateTime();
            $visitDate = new \DateTime($visit->date);

            if ($visitDate > $now) {
                // Pendent de realitzar
                $status = $this->statusService->findStatus('Pendent de realitzar');
            } else {
                // Pendent decisió
                $status = $this->statusService->findStatus('Pendent decisió');
            }
        }

        // Check enrollment/check
        if(!isset($admission->enrollment_date) && $admission->closed) {
            // Matriculació tancada
            $status = $this->statusService->findStatus('No matrícula');
        }

        if (isset($admission->enrollment_date) && $admission->closed) {
            // Matriculació completa
            $status = $this->statusService->findStatus('Matriculació completa');
        }

        // Update status
        if (isset($status)) {
            $this->admission->update($admission->id, ['admission_status_id'=>$status->id]);
        }
    }

}
