<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Lecturer;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');
Route::view('/contact', 'public.contact')->name('contact');
Route::post('/contact', ContactController::class)->name('contact.send');
Route::view('/registration-success', 'auth.registration-success')->middleware('guest')->name('registration.success');

/*
|--------------------------------------------------------------------------
| Signed-in area
|--------------------------------------------------------------------------
| auth:sanctum + Jetstream session  → must be logged in
| approved                          → account approved by the registrar
| role:... / permission:...         → Spatie authorization middleware
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'approved',
])->group(function () {

    // Sends each user to the dashboard for their role
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    /* ---------------- Administrator (Registrar) ---------------- */
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');

        // Records (permission checks are inside each controller's middleware())
        Route::resource('students', Admin\StudentController::class);
        Route::resource('courses', Admin\CourseController::class);
        Route::resource('programmes', Admin\ProgrammeController::class)->except('show');
        Route::resource('lecturers', Admin\LecturerController::class)->except('show');

        // Course registrations
        Route::get('registrations', [Admin\RegistrationController::class, 'index'])->name('registrations.index')->middleware('permission:view registrations');
        Route::get('registrations/create', [Admin\RegistrationController::class, 'create'])->name('registrations.create')->middleware('permission:manage registrations');
        Route::post('registrations', [Admin\RegistrationController::class, 'store'])->name('registrations.store')->middleware('permission:manage registrations');
        Route::delete('registrations/{registration}', [Admin\RegistrationController::class, 'destroy'])->name('registrations.destroy')->middleware('permission:manage registrations');

        // Approvals of online registrations
        Route::middleware('permission:approve registrations')->group(function () {
            Route::get('approvals', [Admin\ApprovalController::class, 'index'])->name('approvals.index');
            Route::post('approvals/{user}/approve', [Admin\ApprovalController::class, 'approve'])->name('approvals.approve');
            Route::post('approvals/{user}/reject', [Admin\ApprovalController::class, 'reject'])->name('approvals.reject');
        });

        // User access (roles)
        Route::middleware('permission:manage users')->group(function () {
            Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
            Route::put('users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
        });

        Route::get('reports', Admin\ReportController::class)->name('reports')->middleware('permission:view reports');
    });

    /* ---------------- Lecturer ---------------- */
    Route::prefix('lecturer')->name('lecturer.')->middleware('role:lecturer')->group(function () {
        Route::get('/dashboard', Lecturer\DashboardController::class)->name('dashboard');
        Route::get('/courses', [Lecturer\CourseController::class, 'index'])->name('courses.index')->middleware('permission:view assigned courses');
        Route::get('/courses/{course}', [Lecturer\CourseController::class, 'show'])->name('courses.show')->middleware('permission:view course students');
        Route::get('/courses/{course}/marks', [Lecturer\MarkController::class, 'edit'])->name('courses.marks.edit')->middleware('permission:enter marks');
        Route::put('/courses/{course}/marks', [Lecturer\MarkController::class, 'update'])->name('courses.marks.update')->middleware('permission:enter marks');
    });

    /* ---------------- Student ---------------- */
    Route::prefix('student')->name('student.')->middleware('role:student')->group(function () {
        Route::get('/dashboard', [Student\PortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/courses', [Student\CourseRegistrationController::class, 'index'])->name('courses.index')->middleware('permission:view available courses');
        Route::post('/courses', [Student\CourseRegistrationController::class, 'store'])->name('courses.store')->middleware('permission:register courses');
        Route::get('/registrations', [Student\CourseRegistrationController::class, 'mine'])->name('registrations.index')->middleware('permission:view own registrations');
        Route::delete('/registrations/{registration}', [Student\CourseRegistrationController::class, 'destroy'])->name('registrations.destroy')->middleware('permission:register courses');
        Route::get('/timetable', [Student\PortalController::class, 'timetable'])->name('timetable')->middleware('permission:view own registrations');
        Route::get('/results', [Student\PortalController::class, 'results'])->name('results')->middleware('permission:view own results');
    });
});
