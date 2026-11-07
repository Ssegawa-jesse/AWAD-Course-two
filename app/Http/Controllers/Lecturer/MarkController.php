<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    public function edit(Course $course)
    {
        $lecturer = Auth::user()->lecturer;

        abort_unless(
            $lecturer && $course->lecturer_id === $lecturer->id,
            403
        );

        $registrations = CourseRegistration::with('student')
            ->where('course_id', $course->id)
            ->get();

        return view('lecturer.marks', compact('course', 'registrations'));
    }

    public function update(Request $request, Course $course)
    {
        $lecturer = Auth::user()->lecturer;

        abort_unless(
            $lecturer && $course->lecturer_id === $lecturer->id,
            403
        );

        $validated = $request->validate([
            'marks' => ['required', 'array'],
            'marks.*.coursework_mark' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'marks.*.exam_mark' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        foreach ($validated['marks'] as $registrationId => $marks) {
            $registration = CourseRegistration::where('course_id', $course->id)
                ->findOrFail($registrationId);

            $registration->coursework_mark = $marks['coursework_mark'] ?? null;
            $registration->exam_mark = $marks['exam_mark'] ?? null;

            if ($registration->total() !== null) {
                $registration->grade = CourseRegistration::gradeFor(
                    $registration->total()
                );
            }

            $registration->save();
        }

        return back()->with('success', 'Marks updated successfully.');
    }
}