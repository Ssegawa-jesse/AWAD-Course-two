<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function edit(Course $course)
    {
        $this->authorize('enterMarks', $course);

        $registrations = $course->registrations()->with('student')->get()->sortBy('student.first_name');

        return view('lecturer.courses.marks', compact('course', 'registrations'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('enterMarks', $course);

        $request->validate([
            'marks' => ['required', 'array'],
            'marks.*.coursework' => ['nullable', 'numeric', 'between:0,30'],
            'marks.*.exam' => ['nullable', 'numeric', 'between:0,70'],
        ], [
            'marks.*.coursework.between' => 'Coursework marks must be between 0 and 30.',
            'marks.*.exam.between' => 'Exam marks must be between 0 and 70.',
        ]);

        $updated = 0;

        DB::transaction(function () use ($request, $course, &$updated) {
            foreach ($request->input('marks') as $registrationId => $marks) {
                // Only rows that really belong to this course can be changed
                $registration = CourseRegistration::where('course_id', $course->id)->find($registrationId);
                if (! $registration) {
                    continue;
                }

                $cw = $marks['coursework'] ?? null;
                $exam = $marks['exam'] ?? null;
                $total = ($cw === null && $exam === null) ? null : (float) $cw + (float) $exam;

                $registration->update([
                    'coursework_mark' => $cw,
                    'exam_mark' => $exam,
                    // Grade only once both parts are in
                    'grade' => ($cw !== null && $exam !== null) ? CourseRegistration::gradeFor($total) : null,
                ]);
                $updated++;
            }
        });

        return redirect()->route('lecturer.courses.marks.edit', $course)->with('success', "Marks saved for {$updated} student(s) in {$course->code}.");
    }
}
