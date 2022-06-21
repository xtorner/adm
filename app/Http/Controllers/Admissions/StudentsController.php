<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admission\StudentRequest;
use App\Services\Admission\AdmissionService;
use App\Services\Course\CourseService;
use App\Services\Admission\StudentService;
use App\Services\Course\SummerMakerService;
use App\Services\Language\LanguageService;
use App\Services\School\SchoolService;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    protected $admissionService;
    protected $studentService;
    protected $courseService;
    protected $summerMakerService;
    protected $languageService;
    protected $schoolService;

    public function __construct(
        AdmissionService $admissionService,
        StudentService $studentService,
        CourseService $courseService,
        SummerMakerService $summerMakerService,
        LanguageService $languageService,
        SchoolService $schoolService
    ){
        $this->middleware(['auth']);

        $this->admissionService = $admissionService;
        $this->studentService = $studentService;
        $this->courseService = $courseService;
        $this->summerMakerService = $summerMakerService;
        $this->languageService = $languageService;
        $this->schoolService = $schoolService;
    }

    public function create($locale, $id)
    {
        $admission = $this->admissionService->read($id);
        $courses = $this->courseService->list();
        $summerMakers = $this->summerMakerService->list();
        $languages = $this->languageService->list();
        $schools = $this->schoolService->list();

        return view('admissions.students.create', [
            'admission' => $admission,
            'courses' => $courses,
            'summerMakers' => $summerMakers,
            'languages' => $languages,
            'schools' => $schools
        ]);
    }

    public function store(StudentRequest $request, $locale, $id)
    {
        $admission = $this->admissionService->read($id);
        $student = $this->studentService->create($request);

        return redirect()->route('admissions.students.edit', ['id'=>$admission->id, 'idStudent' => $student->id])->with('status', 'L\'alumne s\'ha creat correctament');
    }

    public function edit($locale, $id, $idStudent)
    {
        $admission = $this->admissionService->read($id);
        $student = $this->studentService->read($idStudent);
        $courses = $this->courseService->list();
        $summerMakers = $this->summerMakerService->list();
        $languages = $this->languageService->list();
        $schools = $this->schoolService->list();

        return view('admissions.students.edit', [
            'admission' => $admission,
            'student' => $student,
            'courses' => $courses,
            'summerMakers' => $summerMakers,
            'languages' => $languages,
            'schools' => $schools
        ]);
    }

    public function update(StudentRequest $request, $locale, $id, $idStudent)
    {
        $this->studentService->update($request,$idStudent);
        $admission = $this->admissionService->read($id);

        return redirect()->route('admissions.edit', ['id'=>$admission->id])->with('status', 'L\'alumne s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id, $idStudent)
    {
        $this->studentService->delete($idStudent);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
