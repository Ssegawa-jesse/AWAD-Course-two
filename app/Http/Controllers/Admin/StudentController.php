<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Course;
use App\Models\Programme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller implements HasMiddleware
{
    /** Spatie permission middleware for each action. */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view students', only: ['index', 'show']),
            new Middleware('permission:create students', only: ['create', 'store']),
            new Middleware('permission:edit students', only: ['edit', 'update']),
            new Middleware('permission:delete students', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $students = Student::enrolled()
            ->with('programme')
            ->withCount('registrations')
            ->when($request->search, function ($query, $search) {
                $query->where(fn ($q) => $q
                    ->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('student_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"));
            })
            ->when($request->programme, fn ($q, $id) => $q->where('programme_id', $id))
            ->when($request->year, fn ($q, $year) => $q->where('year_of_study', $year))
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.students.index', [
            'students' => $students,
            'programmes' => Programme::orderBy('code')->pluck('code', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.students.create', [
            'student' => new Student(['status' => 'Active', 'year_of_study' => 1]),
            'programmes' => Programme::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function store(StudentRequest $request)
    {
        $data = $request->validated();

        $student = DB::transaction(function () use ($data) {
            // Every student gets a login account with the "student" role.
            $user = User::create([
                'name' => $data['first_name'].' '.$data['last_name'],
                'email' => $data['email'],
                'password' => ($data['password'] ?? null) ?: '12345678',
                'status' => User::STATUS_APPROVED,
                'account_type' => 'student',
            ]);
            $user->assignRole('student');

            return Student::create([
                ...collect($data)->except('password')->all(),
                'user_id' => $user->id,
                'student_number' => ($data['student_number'] ?? null) ?: Student::nextStudentNumber(),
            ]);
        });

        return redirect()->route('admin.students.show', $student)
            ->with('success', "Student {$student->full_name} was added with number {$student->student_number}.");
    }

    public function show(Student $student)
    {
        // Eloquent: the student's registered courses (belongsToMany) with their lecturers
        $student->load(['programme', 'user', 'courses.lecturer.user']);

        $available = Course::whereNotIn('id', $student->courses->pluck('id'))
            ->orderBy('code')
            ->get()
            ->mapWithKeys(fn ($c) => [$c->id => "{$c->code} — {$c->title}"]);

        return view('admin.students.show', compact('student', 'available'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', [
            'student' => $student,
            'programmes' => Programme::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();

        DB::transaction(function () use ($student, $data) {
            $student->update(collect($data)->except('password')->all());

            // Keep the login account in step with the record
            $student->user?->update(array_filter([
                'name' => $student->full_name,
                'email' => $student->email,
                'password' => $data['password'] ?? null,
            ]));
        });

        return redirect()->route('admin.students.show', $student)
            ->with('success', 'Student record updated.');
    }

    public function destroy(Student $student)
    {
        $name = $student->full_name;

        // Deleting the user cascades to the student and their registrations (foreign keys)
        DB::transaction(function () use ($student) {
            $student->user ? $student->user->delete() : $student->delete();
        });

        return redirect()->route('admin.students.index')->with('success', "{$name} was deleted.");
    }
}
