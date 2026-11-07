<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    private function student()
    {
        $student = Auth::user()->student;

        abort_unless($student, 403, 'Student profile not found.');

        return $student;
    }

    public function dashboard()
    {
        $student = $this->student();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->get();

        return view('student.dashboard', [
            'student' => $student,
            'registrations' => $registrations,
            'totalCourses' => $registrations->count(),
            'totalCreditUnits' => $student->totalCreditUnits(),
            'gpa' => $student->gpa(),
        ]);
    }

    public function timetable()
    {
        $student = $this->student();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->get();

        return view('student.timetable', compact('student', 'registrations'));
    }

    public function results()
    {
        $student = $this->student();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->whereNotNull('grade')
            ->get();

        return view('student.results', compact('student', 'registrations'));
    }
}