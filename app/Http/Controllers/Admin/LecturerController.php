<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::with('user')->paginate(10);

        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })->get();

        return view('admin.lecturers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id', 'unique:lecturers,user_id'],
            'staff_number' => ['nullable', 'string', 'max:100', 'unique:lecturers,staff_number'],
            'title' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:255'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        Lecturer::create($validated);

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Lecturer added successfully.');
    }

    public function show(Lecturer $lecturer)
    {
        return view('admin.lecturers.index', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer)
    {
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
            'staff_number' => ['nullable', 'string', 'max:100', Rule::unique('lecturers', 'staff_number')->ignore($lecturer->id)],
            'title' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:255'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $lecturer->update($validated);

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Lecturer updated successfully.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Lecturer deleted successfully.');
    }
}