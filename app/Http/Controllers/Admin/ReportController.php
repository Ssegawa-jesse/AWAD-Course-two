<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Student;

class ReportController extends Controller
{
    public function __invoke()
    {
        return view('admin.reports', [
            'totalStudents' => Student::count(),
            'totalLecturers' => Lecturer::count(),
            'totalCourses' => Course::count(),
            'totalProgrammes' => Programme::count(),
            'totalRegistrations' => CourseRegistration::count(),
        ]);
    }
}
