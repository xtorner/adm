<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Requests\Admission\AnswerRequest;
use App\Http\Requests\Admission\QuestionRequest;
use App\Services\Admission\AnswerService;
use App\Services\Admission\QuestionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
{
    protected $admissionQuestionService;
    protected $admissionAnswerService;

    public function __construct(
        QuestionService $admissionQuestionService,
        AnswerService $admissionAnswerService
    ){
        $this->middleware(['auth']);

        $this->admissionQuestionService = $admissionQuestionService;
        $this->admissionAnswerService = $admissionAnswerService;
    }

    public function index()
    {
        return view('admissions.questions.answers.index', []);
    }

    public function create($locale, $id)
    {
        $question = $this->admissionQuestionService->read($id);

        return view('admissions.questions.answers.create', [
            'question' => $question
        ]);
    }

    public function store(AnswerRequest $request, $locale)
    {
        $this->admissionAnswerService->create($request);

        return redirect()->route('administration.admissions.questions')->with('status', 'La resposta s\'ha creat correctament');
    }

    public function edit($locale, $id, $idAnswer)
    {
        $question = $this->admissionQuestionService->read($id);
        $answer = $this->admissionAnswerService->read($idAnswer);

        return view('admissions.questions.answers.edit', [
            'question' => $question,
            'answer' => $answer
        ]);
    }

    public function update(AnswerRequest $request, $locale, $id, $idAnswer)
    {
        $answer = $this->admissionAnswerService->update($request,$idAnswer);

        return redirect()->route('administration.admissions.questions')->with('status', 'La resposta s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id, $idAnswer)
    {
        $this->admissionAnswerService->delete($idAnswer);

        return back()->with(['status'=>'Eliminada correctament']);
    }
}
