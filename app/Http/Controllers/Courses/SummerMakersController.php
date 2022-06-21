<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\SummerMakerRequest;
use App\Services\Course\SummerMakerService;
use Illuminate\Http\Request;

class SummerMakersController extends Controller
{
    protected $summerMakerService;

    public function __construct(SummerMakerService $summermakerService)
    {
        $this->middleware(['auth']);

        $this->summerMakerService = $summermakerService;
    }

    public function index()
    {
        $summerMakers = $this->summerMakerService->list();

        return view('courses.summermakers.index', ['summerMakers' => $summerMakers]);
    }

    public function create()
    {
        return view('courses.summermakers.create');
    }

    public function store(SummerMakerRequest $request, $locale)
    {
        $this->summerMakerService->create($request);

        return redirect()->route('administration.courses')->with('status', 'Summer Maker s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $summerMaker = $this->summerMakerService->read($id);

        return view('courses.summermakers.edit', compact('summerMaker'));
    }


    public function update(SummermakerRequest $request, $locale, $id)
    {
        $summerMaker = $this->summerMakerService->update($request,$id);

        return redirect()->route('administration.courses')->with('status', 'Summer Maker s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->summerMakerService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
