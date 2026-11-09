<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $lecturer = $request->user()->lecturer;

        // Only this lecturer's courses (hasMany)
        $courses = $lecturer->courses()->with('programme')->withCount('registrations')->orderBy('day')->get();

        $registrations = CourseRegistration::whereIn('course_id', $courses->pluck('id'));

        return view('lecturer.dashboard', [
            'lecturer' => $lecturer,
            'courses' => $courses,
            'stats' => [
                'courses' => $courses->count(),
                'students' => (clone $registrations)->distinct('student_id')->count('student_id'),
                'marked' => (clone $registrations)->whereNotNull('grade')->count(),
                'unmarked' => (clone $registrations)->whereNull('grade')->count(),
            ],
        ]);
    }
}
