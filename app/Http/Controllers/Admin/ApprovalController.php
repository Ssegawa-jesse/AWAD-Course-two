<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', User::STATUS_PENDING);

        $users = User::with(['student.programme', 'lecturer'])
            ->whereIn('account_type', ['student', 'lecturer'])
            ->where('status', $status)
            ->latest()
            ->get();

        return view('admin.approvals.index', [
            'users' => $users,
            'status' => $status,
            'counts' => User::whereIn('account_type', ['student', 'lecturer'])
                ->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
        ]);
    }

    public function approve(User $user)
    {
        if ($user->isApproved()) {
            return back()->with('error', "{$user->name} is already approved.");
        }

        $number = DB::transaction(function () use ($user) {
            $user->update(['status' => User::STATUS_APPROVED]);

            if ($user->account_type === 'student') {
                $student = $user->student ?? Student::create([
                    'user_id' => $user->id, 'email' => $user->email,
                    'first_name' => strtok($user->name, ' '), 'last_name' => trim(strstr($user->name, ' ') ?: ''),
                ]);
                $student->update(['student_number' => $student->student_number ?: Student::nextStudentNumber(), 'status' => 'Active']);
                $user->syncRoles(['student']);

                return 'student number '.$student->student_number;
            }

            $lecturer = $user->lecturer ?? Lecturer::create(['user_id' => $user->id]);
            $lecturer->update(['staff_number' => $lecturer->staff_number ?: Lecturer::nextStaffNumber()]);
            $user->syncRoles(['lecturer']);

            return 'staff number '.$lecturer->staff_number;
        });

        return back()->with('success', "{$user->name} was approved and given {$number}. They can now sign in.");
    }

    public function reject(User $user)
    {
        $user->update(['status' => User::STATUS_REJECTED]);

        return back()->with('success', "The registration for {$user->name} was rejected.");
    }
}
