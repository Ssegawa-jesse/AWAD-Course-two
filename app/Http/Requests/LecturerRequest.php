<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LecturerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage lecturers');
    }

    public function rules(): array
    {
        $lecturer = $this->route('lecturer');

        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($lecturer?->user_id)],
            'title' => ['nullable', Rule::in(['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'])],
            'staff_number' => ['nullable', 'string', 'max:30', Rule::unique('lecturers', 'staff_number')->ignore($lecturer?->id)],
            'department' => ['required', 'string', 'max:150'],
            'qualification' => ['nullable', 'string', 'max:50'],
            'employment_type' => ['required', Rule::in(['Full-time', 'Part-time'])],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
