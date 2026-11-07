<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $lecturer = $user->lecturer;

        $courses = $lecturer
            ? Course::where('lecturer_id', $lecturer->id)->withCount('registrations')->get()
            : collect();

        return view('lecturer.dashboard', [
            'lecturer' => $lecturer,
            'courses' => $courses,
            'totalCourses' => $courses->count(),
            'totalStudents' => CourseRegistration::whereIn(
                'course_id',
                $courses->pluck('id')
            )->distinct('student_id')->count('student_id'),
        ]);
    }
}
