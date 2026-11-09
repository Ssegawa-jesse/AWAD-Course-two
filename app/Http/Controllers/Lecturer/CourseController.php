<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /** Courses assigned to the signed-in lecturer. */
    public function index(Request $request)
    {
        $courses = $request->user()->lecturer->courses()
            ->with('programme')
            ->withCount('registrations')
            ->orderBy('code')
            ->get();

        return view('lecturer.courses.index', compact('courses'));
    }

    /** Class list: students registered for one of the lecturer's courses. */
    public function show(Course $course)
    {
        // CoursePolicy@viewStudents → 403 if this course belongs to another lecturer
        $this->authorize('viewStudents', $course);

        $course->load('programme');
        $students = $course->students()->with('programme')->orderBy('first_name')->get();

        return view('lecturer.courses.show', compact('course', 'students'));
    }
}
