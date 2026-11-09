<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProgrammeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage programmes');
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:20', 'alpha_num', Rule::unique('programmes', 'code')->ignore($this->route('programme')?->id)],
            'name' => ['required', 'string', 'max:150'],
            'faculty' => ['nullable', 'string', 'max:150'],
            'level' => ['required', Rule::in(['Certificate', 'Diploma', 'Bachelor', 'Masters'])],
            'duration_years' => ['required', 'integer', 'between:1,6'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['code' => strtoupper((string) $this->code)]);
    }
}
