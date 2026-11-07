<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $lecturer = Auth::user()->lecturer;

        $courses = $lecturer
            ? Course::where('lecturer_id', $lecturer->id)
                ->withCount('registrations')
                ->paginate(10)
            : Course::whereRaw('1 = 0')->paginate(10);

        return view('lecturer.classes', compact('courses'));
    }

    public function show(Course $course)
    {
        $lecturer = Auth::user()->lecturer;

        abort_unless(
            $lecturer && $course->lecturer_id === $lecturer->id,
            403
        );

        $course->load('registrations.student');

        return view('lecturer.classes', compact('course'));
    }
}