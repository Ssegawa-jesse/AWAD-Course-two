<?php

namespace App\Actions\Fortify;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Self-registration for students and lecturers.
     * The account is created as "pending" until the Registrar approves it.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'account_type' => ['required', Rule::in(['student', 'lecturer'])],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'gender' => ['nullable', Rule::in(Student::GENDERS)],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:students,email'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',

            // Student only
            'programme_id' => ['required_if:account_type,student', 'nullable', 'exists:programmes,id'],
            'study_mode' => ['required_if:account_type,student', 'nullable', Rule::in(Student::MODES)],
            'sponsorship' => ['nullable', Rule::in(Student::SPONSORSHIPS)],
            'date_of_birth' => ['nullable', 'date', 'before:today'],

            // Lecturer only
            'title' => ['nullable', 'string', 'max:10'],
            'department' => ['required_if:account_type,lecturer', 'nullable', 'string', 'max:150'],
            'qualification' => ['nullable', 'string', 'max:50'],
        ], [
            'programme_id.required_if' => 'Please choose your programme.',
            'study_mode.required_if' => 'Please choose your study mode.',
            'department.required_if' => 'Please enter your department.',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $type = $input['account_type'];
            $name = trim(($type === 'lecturer' && ! empty($input['title']) ? $input['title'].' ' : '').$input['first_name'].' '.$input['last_name']);

            $user = User::create([
                'name' => $name,
                'email' => $input['email'],
                'password' => $input['password'],   // hashed by the model cast
                'status' => User::STATUS_PENDING,
                'account_type' => $type,
            ]);

            // Spatie role
            $user->assignRole($type);

            if ($type === 'student') {
                Student::create([
                    'user_id' => $user->id,
                    'programme_id' => $input['programme_id'],
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'] ?? null,
                    'gender' => $input['gender'] ?? null,
                    'date_of_birth' => $input['date_of_birth'] ?? null,
                    'study_mode' => $input['study_mode'],
                    'sponsorship' => $input['sponsorship'] ?? 'Private',
                    'year_of_study' => 1,
                    'status' => 'Active',
                ]);
            } else {
                Lecturer::create([
                    'user_id' => $user->id,
                    'title' => $input['title'] ?? null,
                    'department' => $input['department'],
                    'qualification' => $input['qualification'] ?? null,
                    'phone' => $input['phone'] ?? null,
                ]);
            }

            return $user;
        });
    }
}
