<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $course = $this->route('course');

        return $course
            ? $this->user()->can('update', $course)
            : $this->user()->can('create', Course::class);
    }

    public function rules(): array
    {
        $course = $this->route('course');

        return [
            'code' => ['required', 'string', 'max:20', 'alpha_num', Rule::unique('courses', 'code')->ignore($course?->id)],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'programme_id' => ['required', 'exists:programmes,id'],
            'lecturer_id' => ['nullable', 'exists:lecturers,id'],
            'credit_units' => ['required', 'integer', 'between:1,10'],
            'year_of_study' => ['required', 'integer', 'between:1,5'],
            'semester' => ['required', 'integer', 'in:1,2'],
            'type' => ['required', Rule::in(Course::TYPES)],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
            'day' => ['nullable', Rule::in(Course::DAYS)],
            'start_time' => ['nullable', 'required_with:day', 'date_format:H:i'],
            'end_time' => ['nullable', 'required_with:start_time', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:50'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // "bbc3101" → "BBC3101"; browsers may send times as 08:00:00
        $this->merge([
            'code' => strtoupper((string) $this->code),
            'start_time' => $this->start_time ? substr($this->start_time, 0, 5) : null,
            'end_time' => $this->end_time ? substr($this->end_time, 0, 5) : null,
        ]);
    }

    public function attributes(): array
    {
        return ['programme_id' => 'programme', 'lecturer_id' => 'lecturer'];
    }
}
