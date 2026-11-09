<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CourseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view courses', only: ['index', 'show']),
            new Middleware('permission:create courses', only: ['create', 'store']),
            new Middleware('permission:edit courses', only: ['edit', 'update']),
            new Middleware('permission:delete courses', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $courses = Course::with(['programme', 'lecturer.user'])
            ->withCount('registrations')
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q->where('code', 'like', "%$s%")->orWhere('title', 'like', "%$s%")))
            ->when($request->programme, fn ($q, $id) => $q->where('programme_id', $id))
            ->when($request->year, fn ($q, $y) => $q->where('year_of_study', $y))
            ->orderBy('code')
            ->paginate(10)
            ->withQueryString();

        return view('admin.courses.index', [
            'courses' => $courses,
            'programmes' => Programme::orderBy('code')->pluck('code', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.courses.create', $this->formData(new Course([
            'credit_units' => 3, 'year_of_study' => 1, 'semester' => 1, 'type' => 'Core', 'capacity' => 60,
        ])));
    }

    public function store(CourseRequest $request)
    {
        $course = Course::create($request->validated());

        return redirect()->route('admin.courses.show', $course)->with('success', "Course {$course->code} was created.");
    }

    public function show(Course $course)
    {
        // Eloquent: the students registered for this course (belongsToMany)
        $course->load(['programme', 'lecturer.user', 'students.programme']);

        $available = Student::enrolled()
            ->where('status', 'Active')
            ->whereNotIn('id', $course->students->pluck('id'))
            ->orderBy('first_name')
            ->get()
            ->mapWithKeys(fn ($s) => [$s->id => "{$s->full_name} ({$s->student_number})"]);

        return view('admin.courses.show', compact('course', 'available'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', $this->formData($course));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()->route('admin.courses.show', $course)->with('success', "Course {$course->code} was updated.");
    }

    public function destroy(Course $course)
    {
        if ($course->registrations()->exists()) {
            return back()->with('error', "{$course->code} has registered students. Remove their registrations first.");
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', "Course {$course->code} was deleted.");
    }

    private function formData(Course $course): array
    {
        return [
            'course' => $course,
            'programmes' => Programme::orderBy('name')->pluck('name', 'id'),
            'lecturers' => Lecturer::with('user')->whereNotNull('staff_number')->get()
                ->mapWithKeys(fn ($l) => [$l->id => $l->name.' — '.$l->department]),
        ];
    }
}
