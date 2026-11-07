<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'totalStudents' => Student::count(),
            'totalLecturers' => Lecturer::count(),
            'totalCourses' => Course::count(),
            'totalProgrammes' => Programme::count(),
            'totalRegistrations' => CourseRegistration::count(),
            'pendingUsers' => User::where('status', User::STATUS_PENDING)->count(),
            'recentStudents' => Student::with('programme')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
