<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        $programmes = Programme::orderBy('name')->get();

        return view('register', compact('programmes'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', Rule::in(['student', 'lecturer', 'admin'])],
        ]);

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->onlyInput('email', 'role');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // The selected role must match the actual assigned role.
        if (!$user->hasRole($credentials['role'])) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors(['email' => 'Your account does not have the selected role.'])
                ->onlyInput('email', 'role');
        }

        if (!$user->isApproved()) {
            return redirect()->route('account.status');
        }

        return redirect()->intended(route('dashboard'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'account_type' => [
                'required',
                Rule::in(['student', 'lecturer']),
            ],

            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'gender' => ['required', Rule::in(['Female', 'Male'])],
            'dob' => ['required', 'date', 'before:today'],
            'nationality' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'district' => ['required', 'string', 'max:100'],

            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],

            'photo' => ['nullable', 'image', 'max:2048'],

            'programme_id' => [
                'required_if:account_type,student',
                'nullable',
                'exists:programmes,id',
            ],
            'study_mode' => [
                'required_if:account_type,student',
                'nullable',
                Rule::in(Student::MODES),
            ],
            'sponsorship' => [
                'required_if:account_type,student',
                'nullable',
                Rule::in(Student::SPONSORSHIPS),
            ],
            'scheme' => ['required_if:account_type,student', 'nullable', 'string', 'max:100'],
            'uace_index' => ['nullable', 'string', 'max:100'],
            'guardian_name' => ['required_if:account_type,student', 'nullable', 'string', 'max:150'],
            'guardian_relation' => ['required_if:account_type,student', 'nullable', 'string', 'max:100'],
            'guardian_phone' => ['required_if:account_type,student', 'nullable', 'string', 'max:30'],

            'title' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:50'],
            'staff_no' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:100', 'unique:lecturers,staff_number'],
            'department' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:150'],
            'qualification' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:150'],
            'employment' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:100'],
            'specialisation' => ['nullable', 'string', 'max:150'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $photoPath = null;
        $cvPath = null;

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                &$photoPath,
                &$cvPath
            ) {
                $accountType = $validated['account_type'];

                $user = User::create([
                    'name' => trim($validated['first_name'].' '.$validated['last_name']),
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'status' => User::STATUS_PENDING,
                    'account_type' => $accountType,
                ]);

                $user->assignRole($accountType);

                if ($accountType === 'student') {
                    if ($request->hasFile('photo')) {
                        $photoPath = $request->file('photo')
                            ->store('student-photos', 'public');
                    }

                    Student::create([
                        'user_id' => $user->id,
                        'programme_id' => $validated['programme_id'],
                        'first_name' => $validated['first_name'],
                        'last_name' => $validated['last_name'],
                        'email' => $validated['email'],
                        'phone' => $validated['phone'],
                        'gender' => $validated['gender'],
                        'date_of_birth' => $validated['dob'],
                        'year_of_study' => 1,
                        'study_mode' => $validated['study_mode'],
                        'sponsorship' => $validated['sponsorship'],
                        'status' => 'Inactive',
                        'nationality' => $validated['nationality'],
                        'district' => $validated['district'],
                        'photo_path' => $photoPath,
                        'entry_scheme' => $validated['scheme'],
                        'uace_index' => $validated['uace_index'] ?? null,
                        'guardian_name' => $validated['guardian_name'],
                        'guardian_relationship' => $validated['guardian_relation'],
                        'guardian_phone' => $validated['guardian_phone'],
                    ]);
                }

                if ($accountType === 'lecturer') {
                    if ($request->hasFile('cv')) {
                        $cvPath = $request->file('cv')
                            ->store('lecturer-documents');
                    }

                    Lecturer::create([
                        'user_id' => $user->id,
                        'staff_number' => $validated['staff_no'],
                        'title' => $validated['title'],
                        'department' => $validated['department'],
                        'qualification' => $validated['qualification'],
                        'employment_type' => $validated['employment'],
                        'phone' => $validated['phone'],
                        'specialisation' => $validated['specialisation'] ?? null,
                        'cv_path' => $cvPath,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            if ($cvPath) {
                Storage::disk('local')->delete($cvPath);
            }

            throw $exception;
        }

        return redirect()
            ->route('registration.success')
            ->with('success', 'Your registration has been submitted. Please wait for approval.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

