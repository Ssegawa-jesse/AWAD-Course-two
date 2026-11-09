<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LecturerRequest;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('permission:manage lecturers')];
    }

    public function index()
    {
        return view('admin.lecturers.index', [
            'lecturers' => Lecturer::with('user')->withCount('courses')->whereNotNull('staff_number')->get()->sortBy('name'),
        ]);
    }

    public function create()
    {
        return view('admin.lecturers.create', ['lecturer' => new Lecturer(['employment_type' => 'Full-time'])]);
    }

    public function store(LecturerRequest $request)
    {
        $data = $request->validated();

        $lecturer = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => ($data['password'] ?? null) ?: '12345678',
                'status' => User::STATUS_APPROVED,
                'account_type' => 'lecturer',
            ]);
            $user->assignRole('lecturer');

            return Lecturer::create([
                ...collect($data)->except(['name', 'email', 'password'])->all(),
                'user_id' => $user->id,
                'staff_number' => ($data['staff_number'] ?? null) ?: Lecturer::nextStaffNumber(),
            ]);
        });

        return redirect()->route('admin.lecturers.index')->with('success', "{$lecturer->name} was added with staff number {$lecturer->staff_number}.");
    }

    public function edit(Lecturer $lecturer)
    {
        $lecturer->load('user');

        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(LecturerRequest $request, Lecturer $lecturer)
    {
        $data = $request->validated();

        DB::transaction(function () use ($lecturer, $data) {
            $lecturer->update(collect($data)->except(['name', 'email', 'password'])->all());
            $lecturer->user->update(array_filter([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'] ?? null,
            ]));
        });

        return redirect()->route('admin.lecturers.index')->with('success', "{$lecturer->name} was updated.");
    }

    public function destroy(Lecturer $lecturer)
    {
        $name = $lecturer->name;

        // Courses keep existing; their lecturer_id becomes NULL (nullOnDelete)
        $lecturer->user->delete();

        return redirect()->route('admin.lecturers.index')->with('success', "{$name} was removed. Their courses are now unassigned.");
    }
}
