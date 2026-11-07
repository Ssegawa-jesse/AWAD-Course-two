<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = CourseRegistration::with(['student', 'course'])
            ->latest()
            ->paginate(10);

        return view('admin.registrations.index', compact('registrations'));
    }

    public function create()
    {
        $students = Student::orderBy('first_name')->get();
        $courses = Course::orderBy('title')->get();

        return view('admin.registrations.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'academic_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'max:50'],
        ]);

        CourseRegistration::create($validated);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration created successfully.');
    }

    public function destroy(CourseRegistration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration deleted successfully.');
    }
}