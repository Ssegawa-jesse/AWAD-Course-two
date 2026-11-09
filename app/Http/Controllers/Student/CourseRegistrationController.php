<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Services\CourseRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourseRegistrationController extends Controller
{
    /** Available courses for the student's programme + other electives. */
    public function index(Request $request)
    {
        $student = $request->user()->student->load('programme');
        $registeredIds = $student->courses()->pluck('courses.id');

        $courses = Course::with('lecturer.user')
            ->withCount('registrations')
            ->when($request->boolean('all') === false, fn ($q) => $q->where('programme_id', $student->programme_id))
            ->orderBy('year_of_study')->orderBy('code')
            ->get();

        return view('student.courses', [
            'student' => $student,
            'courses' => $courses,
            'registeredIds' => $registeredIds,
            'credits' => $student->totalCreditUnits(),
            'maxCredits' => CourseRegistrationService::MAX_CREDIT_UNITS,
            'showAll' => $request->boolean('all'),
        ]);
    }

    /** Register for one or more ticked courses. */
    public function store(Request $request, CourseRegistrationService $service)
    {
        $data = $request->validate([
            'course_ids' => ['required', 'array', 'min:1'],
            'course_ids.*' => ['integer', 'distinct', 'exists:courses,id'],
        ], [
            'course_ids.required' => 'Tick at least one course to register.',
        ]);

        // The student comes from the signed-in user — never from the form.
        $student = $request->user()->student;
        $registered = [];
        $errors = [];

        foreach (Course::whereIn('id', $data['course_ids'])->get() as $course) {
            try {
                $service->register($student, $course);
                $registered[] = $course->code;
            } catch (ValidationException $e) {
                $errors[] = collect($e->errors())->flatten()->first();
            }
        }

        $redirect = redirect()->route('student.courses.index');

        if ($registered) {
            $redirect->with('success', 'Registered for: '.implode(', ', $registered).'.');
        }
        if ($errors) {
            $redirect->with('error', implode(' ', $errors));
        }

        return $redirect;
    }

    /** The student's own registrations. */
    public function mine(Request $request)
    {
        $student = $request->user()->student;
        $registrations = $student->registrations()->with('course.lecturer.user')->get()->sortBy('course.code');

        return view('student.registrations', [
            'student' => $student,
            'registrations' => $registrations,
            'credits' => $registrations->sum(fn ($r) => $r->course->credit_units),
        ]);
    }

    /** Drop a course. The policy makes sure it is the student's own registration. */
    public function destroy(CourseRegistration $registration)
    {
        $this->authorize('delete', $registration);

        $code = $registration->course->code;
        $registration->delete();

        return redirect()->route('student.registrations.index')->with('success', "You dropped {$code}.");
    }
}
