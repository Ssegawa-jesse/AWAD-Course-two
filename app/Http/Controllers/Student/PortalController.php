<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function dashboard(Request $request)
    {
        $student = $request->user()->student->load('programme');

        // Eloquent: this student's registered courses (belongsToMany)
        $courses = $student->courses()->with('lecturer.user')->get();

        $today = now()->format('l');

        return view('student.dashboard', [
            'student' => $student,
            'courses' => $courses,
            'todayClasses' => $courses->where('day', $today)->sortBy('start_time'),
            'today' => $today,
            'credits' => $courses->sum('credit_units'),
            'gpa' => $student->gpa(),
            'availableCount' => Course::where('programme_id', $student->programme_id)->whereNotIn('id', $courses->pluck('id'))->count(),
        ]);
    }

    public function timetable(Request $request)
    {
        $courses = $request->user()->student->courses()->with('lecturer.user')->get();

        $days = collect(Course::DAYS)->mapWithKeys(fn ($day) => [
            $day => $courses->where('day', $day)->sortBy('start_time')->values(),
        ]);

        return view('student.timetable', compact('days', 'courses'));
    }

    public function results(Request $request)
    {
        $student = $request->user()->student;
        $registrations = $student->registrations()->with('course')->get()->sortBy('course.code');

        return view('student.results', [
            'student' => $student,
            'registrations' => $registrations,
            'gpa' => $student->gpa(),
        ]);
    }
}
