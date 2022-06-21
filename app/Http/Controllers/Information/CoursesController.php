<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use App\Http\Requests\Information\CourseRequest;
use App\Services\Information\CourseService;
use DateTime;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->middleware(['auth']);

        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->list();
        return view('information.courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        $datetime = new DateTime();
        $year = (int) $datetime->format('Y');
        return view('information.courses.create', [
            'year' => $year
        ]);
    }

    public function store(CourseRequest $request, $locale)
    {
        //return $request;
        $this->courseService->create($request);
        return redirect()->route('administration.information.courses')->with('status', 'El curs s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $course = $this->courseService->read($id);

        return view('information.courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, $locale, $id)
    {
        $course = $this->courseService->update($request,$id);

        return redirect()->route('administration.information.courses')->with('status', 'El curs s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->courseService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
