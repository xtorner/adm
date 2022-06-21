<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\SchoolRequest;
use App\Services\School\SchoolService;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    protected $schoolService;

    public function __construct(
        SchoolService $schoolService
    ){
        $this->middleware(['auth']);

        $this->schoolService = $schoolService;
    }

    public function index()
    {
        $schools = $this->schoolService->list();

        return view('schools.index', [
            'schools' => $schools,
        ]);
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(SchoolRequest $request, $locale)
    {
        $this->schoolService->create($request);

        return redirect()->route('administration.schools')->with('status', 'L\'escola s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $school = $this->schoolService->read($id);

        return view('schools.edit', compact('school'));
    }


    public function update(SchoolRequest $request, $locale, $id)
    {
        $school = $this->schoolService->update($request,$id);

        return redirect()->route('administration.schools')->with('status', 'L\'escola s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->schoolService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
