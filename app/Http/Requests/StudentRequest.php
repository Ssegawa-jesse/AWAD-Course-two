<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $student = $this->route('student');

        return $student
            ? $this->user()->can('update', $student)
            : $this->user()->can('create', Student::class);
    }

    public function rules(): array
    {
        $student = $this->route('student');
        $userId = $student?->user_id;

        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('students', 'email')->ignore($student?->id),
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['required', Rule::in(Student::GENDERS)],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'student_number' => ['nullable', 'string', 'max:20', Rule::unique('students', 'student_number')->ignore($student?->id)],
            'registration_number' => ['nullable', 'string', 'max:30', Rule::unique('students', 'registration_number')->ignore($student?->id)],
            'programme_id' => ['required', 'exists:programmes,id'],
            'year_of_study' => ['required', 'integer', 'between:1,5'],
            'study_mode' => ['required', Rule::in(Student::MODES)],
            'sponsorship' => ['required', Rule::in(Student::SPONSORSHIPS)],
            'status' => ['required', Rule::in(Student::STATUSES)],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function attributes(): array
    {
        return ['programme_id' => 'programme'];
    }
}
