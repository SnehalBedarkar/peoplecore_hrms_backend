<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dobRule = 'required|date';

        // Apply 18+ rule only if NOT intern
        if ($this->employment_type !== 'intern') {
            $dobRule .= '|before:'.now()->subYears(18)->format('Y-m-d');
        }

        return [
            'department_id' => 'required|integer|exists:departments,id',
            'designation_id' => 'required|integer|exists:designations,id',
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|email|unique:employees,email',
            'mobile_number' => 'required|string|max:15|unique:employees,mobile_number',
            'gender' => 'required|in:male,female',
            'date_of_birth' => $dobRule,
            'joining_date' => 'nullable|date',
            'employment_type' => 'nullable|in:full_time,part_time,contract,intern',
            'status' => 'nullable|boolean',
        ];
    }
}
