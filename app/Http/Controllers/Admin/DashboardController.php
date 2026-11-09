<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $active = Student::enrolled()->where('status', 'Active')->count();
        $registered = Student::enrolled()->where('status', 'Active')->has('registrations')->count();

        return view('admin.dashboard', [
            'stats' => [
                'active' => $active,
                'pending' => User::where('status', User::STATUS_PENDING)->count(),
                'courses' => Course::count(),
                'registrations' => CourseRegistration::count(),
                'registered_pct' => $active ? round($registered / $active * 100) : 0,
                'not_registered' => $active - $registered,
            ],
            'byProgramme' => Programme::withCount(['students' => fn ($q) => $q->enrolled()])->orderByDesc('students_count')->get(),
            'pendingUsers' => User::where('status', User::STATUS_PENDING)->latest()->take(5)->get(),
            'recentStudents' => Student::enrolled()->with('programme')->latest('updated_at')->take(5)->get(),
        ]);
    }
}
