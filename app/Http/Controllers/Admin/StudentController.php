<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('programme')
            ->latest()
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $programmes = Programme::orderBy('name')->get();

        return view('admin.students.create', compact('programmes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'student_number' => ['nullable', 'string', 'max:255', 'unique:students,student_number'],
            'registration_number' => ['nullable', 'string', 'max:255', 'unique:students,registration_number'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:students,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'year_of_study' => ['nullable', 'integer', 'min:1'],
            'study_mode' => ['nullable', 'string', 'max:100'],
            'sponsorship' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load('programme', 'registrations.course');

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $programmes = Programme::orderBy('name')->get();

        return view('admin.students.edit', compact('student', 'programmes'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'programme_id' => ['nullable', 'exists:programmes,id'],
            'student_number' => ['nullable', 'string', 'max:255', Rule::unique('students', 'student_number')->ignore($student->id)],
            'registration_number' => ['nullable', 'string', 'max:255', Rule::unique('students', 'registration_number')->ignore($student->id)],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'year_of_study' => ['nullable', 'integer', 'min:1'],
            'study_mode' => ['nullable', 'string', 'max:100'],
            'sponsorship' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:50'],
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
