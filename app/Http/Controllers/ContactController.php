<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'student_no' => ['nullable', 'string', 'max:20'],
            'topic' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        // For the coursework the message is written to the log (storage/logs/laravel.log).
        Log::info('Contact form message', $data);

        return back()->with('success', 'Thank you, '.$data['name'].'. Your message has been sent to the Registrar\'s office.');
    }
}
