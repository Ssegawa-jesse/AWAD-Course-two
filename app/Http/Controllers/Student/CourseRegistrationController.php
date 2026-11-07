<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationController extends Controller
{
    private function student()
    {
        $student = Auth::user()->student;

        abort_unless($student, 403, 'Student profile not found.');

        return $student;
    }

    public function index()
    {
        $student = $this->student();

        $courses = Course::with('programme', 'lecturer')
            ->withCount('registrations')
            ->orderBy('code')
            ->paginate(10);

        return view('student.courses', compact('student', 'courses'));
    }

    public function store(Request $request)
    {
        $student = $this->student();

        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $course = Course::findOrFail($validated['course_id']);

        if (CourseRegistration::where('student_id', $student->id)
            ->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already registered for this course.');
        }

        if ($course->isFull()) {
            return back()->with('error', 'This course has reached its capacity.');
        }

        CourseRegistration::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'academic_year' => '2026/2027',
            'semester' => $course->semester ?? 1,
            'status' => 'Registered',
        ]);

        return back()->with('success', 'Course registration successful.');
    }

    public function mine()
    {
        $student = $this->student();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->latest()
            ->paginate(10);

        return view('student.courses', compact('student', 'registrations'));
    }

    public function destroy(CourseRegistration $registration)
    {
        $student = $this->student();

        abort_unless($registration->student_id === $student->id, 403);

        $registration->delete();

        return back()->with('success', 'Course registration removed successfully.');
    }
}