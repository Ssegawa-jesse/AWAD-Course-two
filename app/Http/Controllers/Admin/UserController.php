<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    User::STATUS_PENDING,
                    User::STATUS_APPROVED,
                    User::STATUS_REJECTED,
                ]),
            ],
        ]);

        $user->update($validated);

        return back()->with('success', 'User account updated successfully.');
    }
}