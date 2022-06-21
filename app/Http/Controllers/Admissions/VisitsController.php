<?php

namespace App\Http\Controllers\Admissions;

use App\Http\Requests\Admission\QuestionRequest;
use App\Http\Requests\Admission\VisitRequest;
use App\Services\Admission\AdmissionService;
use App\Services\Admission\QuestionService;
use App\Services\Admission\VisitService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitsController extends Controller
{
    protected $admissionService;
    protected $visitService;

    public function __construct(
        AdmissionService $admissionService,
        VisitService $visitService
    ){
        $this->middleware(['auth']);

        $this->admissionService = $admissionService;
        $this->visitService = $visitService;
    }

    public function create($locale, $id)
    {
        $admission = $this->admissionService->read($id);
        return view('admissions.visits.create', [
            'admission' => $admission
        ]);
    }

    public function store(VisitRequest $request, $locale, $id)
    {
        $admission = $this->admissionService->read($id);
        $visit = $this->visitService->create($request);
        $this->admissionService->checkAndUpdateStatus($admission);

        return redirect()->route('admissions.visits.edit', ['id'=>$admission->id, 'idVisit' => $visit->id])->with('status', 'La visita s\'ha creat correctament');
    }

    public function edit($locale, $id, $idVisit)
    {
        $admission = $this->admissionService->read($id);
        $visit = $this->visitService->read($idVisit);

        return view('admissions.visits.edit', [
            'visit' => $visit,
            'admission' => $admission
        ]);
    }

    public function update(VisitRequest $request, $locale, $id, $idVisit)
    {
        $admission = $this->admissionService->read($id);
        $visit = $this->visitService->update($request,$idVisit);
        $this->admissionService->checkAndUpdateStatus($admission);

        return redirect()->route('admissions.edit', ['id'=>$admission->id])->with('status', 'La visita s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id, $idVisit)
    {
        $admission = $this->admissionService->read($id);
        $this->visitService->delete($idVisit);
        $this->admissionService->checkAndUpdateStatus($admission);

        return back()->with(['status'=>'Eliminada correctament']);
    }
}
