<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use App\Models\Student;

class ReportController extends Controller
{
    public function __invoke()
    {
        return view('admin.reports', [
            'programmes' => Programme::withCount(['students' => fn ($q) => $q->enrolled(), 'courses'])->orderBy('code')->get(),
            'courses' => Course::with('lecturer.user')->withCount('registrations')->orderByDesc('registrations_count')->get(),
            'statusCounts' => Student::enrolled()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status'),
            'gradeCounts' => CourseRegistration::whereNotNull('grade')->selectRaw('grade, count(*) as total')->groupBy('grade')->pluck('total', 'grade'),
        ]);
    }
}
