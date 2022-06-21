<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Requests\Admission\QuestionRequest;
use App\Services\Admission\QuestionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    protected $admissionQuestionService;

    public function __construct(QuestionService $admissionQuestionService)
    {
        $this->middleware(['auth']);

        $this->admissionQuestionService = $admissionQuestionService;
    }

    public function index()
    {
        $questions = $this->admissionQuestionService->list();

        return view('admissions.questions.index', [
            'questions' => $questions,
        ]);
    }

    public function create($locale)
    {
        return view('admissions.questions.create');
    }

    public function store(QuestionRequest $request, $locale)
    {
        $this->admissionQuestionService->create($request);

        return redirect()->route('administration.admissions.questions')->with('status', 'La pregunta s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $question = $this->admissionQuestionService->read($id);

        return view('admissions.questions.edit', compact('question'));
    }

    public function update(QuestionRequest $request, $locale, $id)
    {
        $question = $this->admissionQuestionService->update($request,$id);

        return redirect()->route('administration.admissions.questions')->with('status', 'La pregunta s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->admissionQuestionService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
