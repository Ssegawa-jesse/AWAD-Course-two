<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /** Send the user to the dashboard that matches their Spatie role. */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return match (true) {
            $user->hasRole('admin') => redirect()->route('admin.dashboard'),
            $user->hasRole('lecturer') => redirect()->route('lecturer.dashboard'),
            $user->hasRole('student') => redirect()->route('student.dashboard'),
            default => abort(403, 'Your account has no role yet. Please contact the Registrar.'),
        };
    }
}
