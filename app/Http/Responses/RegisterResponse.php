<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Fortify logs a new user in straight after registering.
     * New accounts must be approved first, so we log them out again.
     */
    public function toResponse($request)
    {
        $name = Auth::user()?->name;

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('registration.success')->with('registered_name', $name);
    }
}
