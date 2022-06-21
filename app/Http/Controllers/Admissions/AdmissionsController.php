<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Requests\Admission\AdmissionRequest;
use App\Services\Admission\QuestionService;
use App\Services\Admission\AdmissionService;
use App\Services\Admission\StudentService;
use App\Services\Admission\VisitService;
use App\Services\Language\LanguageService;
use App\Services\Information\CourseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdmissionsController extends Controller
{
    protected $admissionService;
    protected $admissionQuestionService;
    protected $studentService;
    protected $visitService;
    protected $languageService;
    protected $courseService;

    public function __construct(AdmissionService $admissionService,
                                QuestionService $admissionQuestionService,
                                StudentService $studentService,
                                VisitService $visitService,
                                LanguageService $languageService,
                                CourseService $courseService
    ){
        $this->middleware(['auth']);

        $this->admissionService = $admissionService;
        $this->admissionQuestionService = $admissionQuestionService;
        $this->studentService = $studentService;
        $this->visitService = $visitService;
        $this->languageService = $languageService;
        $this->courseService = $courseService;
    }

    public function index()
    {
        $admissions = $this->admissionService->list();
        $courses    = $this->courseService->list();

        // return $courses;
        return view('admissions.index', 
            [
                'admissions'    => $admissions,
                'courses'       => $courses
            ]);
    }

    public function create()
    {
        $questions = $this->admissionQuestionService->list();

        return view('admissions.create', [
            'questions' => $questions,
        ]);
    }

    public function store(AdmissionRequest $request, $locale)
    {
        if($this->admissionService->check($request)) {
            return redirect()->route('admissions.check', ['name'=>$request->get('name')])->with('status', 'L\'admissió ja existeix, estàs segur de voler crear?');
        } else {
            $admission = $this->admissionService->create($request);
            return redirect()->route('admissions.edit', ['id'=>$admission->id])->with('status', 'L\'admissió s\'ha creat correctament');
        }
    }

    public function check($locale, $name)
    {
        $questions = $this->admissionQuestionService->list();

        return view('admissions.check', [
            'questions' => $questions,
            'name' => $name
        ]);
    }

    public function checkStore(AdmissionRequest $request, $locale)
    {
        $admission = $this->admissionService->create($request);
        return redirect()->route('admissions.edit', ['id'=>$admission->id])->with('status', 'L\'admissió s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $questions = $this->admissionQuestionService->list();
        $admission = $this->admissionService->read($id);
        $students = $this->studentService->list($admission->id);
        $visits = $this->visitService->list($admission->id);
        $languages = $this->languageService->list();

        return view('admissions.edit', [
            'admission' => $admission,
            'students' => $students,
            'visits' => $visits,
            'questions' => $questions,
            'admissionService' => $this->admissionService,
            'languages' => $languages
        ]);
    }

    public function update(AdmissionRequest $request, $locale, $id)
    {
        $this->admissionService->update($request,$id);
        $admission = $this->admissionService->read($id);
        $this->admissionService->checkAndUpdateStatus($admission);

        return redirect()->route('admissions.edit', ['id'=>$admission->id])->with('status', 'L\'admissió s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->admissionService->delete($id);

        return back()->with(['status'=>'Eliminada correctament']);
    }
}
