<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['programme', 'lecturer'])
            ->withCount('registrations')
            ->latest()
            ->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $programmes = Programme::orderBy('name')->get();
        $lecturers = Lecturer::with('user')->get();

        return view('admin.courses.create', compact('programmes', 'lecturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'lecturer_id' => ['nullable', 'exists:lecturers,id'],
            'code' => ['required', 'string', 'max:50', 'unique:courses,code'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'credit_units' => ['required', 'integer', 'min:1'],
            'year_of_study' => ['nullable', 'integer', 'min:1'],
            'semester' => ['nullable', 'integer', 'min:1'],
            'type' => ['nullable', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'day' => ['nullable', 'string', 'max:30'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        return redirect()->route('admin.courses.edit', $course);
    }

    public function edit(Course $course)
    {
        $programmes = Programme::orderBy('name')->get();
        $lecturers = Lecturer::with('user')->get();

        return view('admin.courses.edit', compact('course', 'programmes', 'lecturers'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'lecturer_id' => ['nullable', 'exists:lecturers,id'],
            'code' => ['required', 'string', 'max:50', Rule::unique('courses', 'code')->ignore($course->id)],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'credit_units' => ['required', 'integer', 'min:1'],
            'year_of_study' => ['nullable', 'integer', 'min:1'],
            'semester' => ['nullable', 'integer', 'min:1'],
            'type' => ['nullable', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'day' => ['nullable', 'string', 'max:30'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
