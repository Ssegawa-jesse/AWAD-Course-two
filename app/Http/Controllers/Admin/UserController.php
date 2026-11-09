<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles')
            ->when($request->role, fn ($q, $role) => $q->role($role))   // Spatie scope
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%")))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => Role::with('permissions')->orderBy('name')->get(),
        ]);
    }

    /** Change a user's role and/or account status (user access). */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', Rule::exists('roles', 'name')],
            'status' => ['required', Rule::in([User::STATUS_APPROVED, User::STATUS_PENDING, User::STATUS_REJECTED])],
        ]);

        if ($user->is($request->user()) && ($data['role'] !== 'admin' || $data['status'] !== User::STATUS_APPROVED)) {
            return back()->with('error', 'You cannot remove your own administrator access.');
        }

        $user->syncRoles([$data['role']]);
        $user->update(['status' => $data['status'], 'account_type' => $data['role']]);

        // Make sure the matching profile record exists for the new role
        if ($data['role'] === 'lecturer' && ! $user->lecturer) {
            Lecturer::create(['user_id' => $user->id, 'staff_number' => Lecturer::nextStaffNumber(), 'department' => 'Not set']);
        }
        if ($data['role'] === 'student' && ! $user->student) {
            [$first, $last] = array_pad(explode(' ', $user->name, 2), 2, '');
            Student::create([
                'user_id' => $user->id, 'email' => $user->email, 'first_name' => $first, 'last_name' => $last,
                'student_number' => Student::nextStudentNumber(),
            ]);
        }

        return back()->with('success', "{$user->name} is now a {$data['role']} ({$data['status']}).");
    }
}
