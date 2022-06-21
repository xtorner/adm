<?php

namespace App\Http\Controllers;

use App\Services\Admission\AdmissionService;
use Illuminate\Http\Request;
use App\Services\Information\CourseService;

class DashboardController extends Controller
{
    protected $admissionService;
    protected $courseService;

    public function __construct(
        AdmissionService $admissionService,
        CourseService $courseService
    ){
        $this->middleware('auth');

        $this->admissionService = $admissionService;
        $this->courseService = $courseService;
        
    }

    public function index()
    {
        $admissions = $this->admissionService->list();
        $courses    = $this->courseService->list();

        return view('dashboard.dashboard', 
            [
                'admissions' => $admissions,
                'courses'       => $courses
            ]);
    }
}
