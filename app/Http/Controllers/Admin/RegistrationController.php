<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Services\CourseRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registrations = CourseRegistration::with(['student.programme', 'course.lecturer.user'])
            ->when($request->course, fn ($q, $id) => $q->where('course_id', $id))
            ->when($request->search, fn ($q, $s) => $q->whereHas('student', fn ($q) => $q
                ->where('first_name', 'like', "%$s%")->orWhere('last_name', 'like', "%$s%")->orWhere('student_number', 'like', "%$s%")))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'courses' => Course::orderBy('code')->pluck('code', 'id'),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.registrations.create', [
            'students' => Student::enrolled()->where('status', 'Active')->orderBy('first_name')->get()
                ->mapWithKeys(fn ($s) => [$s->id => "{$s->full_name} ({$s->student_number})"]),
            'courses' => Course::orderBy('code')->get()->mapWithKeys(fn ($c) => [$c->id => "{$c->code} — {$c->title}"]),
            'selectedStudent' => $request->student,
            'selectedCourse' => $request->course,
        ]);
    }

    public function store(Request $request, CourseRegistrationService $service)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => [
                'required', 'exists:courses,id',
                // Duplicate-registration prevention at validation level
                Rule::unique('course_registrations')->where('student_id', $request->student_id),
            ],
        ], [
            'course_id.unique' => 'This student is already registered for that course.',
        ]);

        $student = Student::findOrFail($data['student_id']);
        $course = Course::findOrFail($data['course_id']);

        $service->register($student, $course);

        return redirect($request->input('redirect_to', route('admin.registrations.index')))
            ->with('success', "{$student->full_name} was registered for {$course->code}.");
    }

    public function destroy(Request $request, CourseRegistration $registration)
    {
        $this->authorize('delete', $registration);

        $registration->load(['student', 'course']);
        $registration->delete();

        return back()->with('success', "{$registration->student->full_name} was removed from {$registration->course->code}.");
    }
}
