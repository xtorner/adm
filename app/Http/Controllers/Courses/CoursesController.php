<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseRequest;
use App\Services\Course\CourseService;
use App\Services\Course\SummerMakerService;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    protected $courseService;
    protected $summerMakerService;

    public function __construct(
        CourseService $courseService,
        SummerMakerService $summermakerService
    ){
        $this->middleware(['auth']);

        $this->courseService = $courseService;
        $this->summerMakerService = $summermakerService;
    }

    public function index()
    {
        $courses = $this->courseService->list();
        $summerMakers = $this->summerMakerService->list();

        return view('courses.index', [
            'courses' => $courses,
            'summerMakers' => $summerMakers
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request, $locale)
    {
        $this->courseService->create($request);

        return redirect()->route('administration.courses')->with('status', 'El curs s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $course = $this->courseService->read($id);

        return view('courses.edit', compact('course'));
    }


    public function update(CourseRequest $request, $locale, $id)
    {
        $course = $this->courseService->update($request,$id);

        return redirect()->route('administration.courses')->with('status', 'El curs s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->courseService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
