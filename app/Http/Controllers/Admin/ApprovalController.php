<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApprovalController extends Controller
{
    public function index(): View
    {
        $users = User::where('status', User::STATUS_PENDING)
            ->latest()
            ->paginate(10);

        return view('admin.applications.index', compact('users'));
    }

    public function approve(User $user): RedirectResponse
    {
        if ($user->status !== User::STATUS_PENDING) {
            return back()->with('error', 'This account is not pending approval.');
        }

        $user->update([
            'status' => User::STATUS_APPROVED,
        ]);

        return back()->with('success', 'User account approved successfully.');
    }

    public function reject(User $user): RedirectResponse
    {
        if ($user->status !== User::STATUS_PENDING) {
            return back()->with('error', 'This account is not pending approval.');
        }

        $user->update([
            'status' => User::STATUS_REJECTED,
        ]);

        return back()->with('success', 'User account rejected successfully.');
    }
}