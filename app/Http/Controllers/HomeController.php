<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Student;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'programmes' => Programme::orderBy('code')->take(6)->get(),
            'stats' => [
                'students' => Student::enrolled()->count(),
                'lecturers' => Lecturer::whereNotNull('staff_number')->count(),
                'programmes' => Programme::count(),
            ],
        ]);
    }
}
