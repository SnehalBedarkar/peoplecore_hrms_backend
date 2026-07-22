<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RoleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->name ? Str::slug($this->name) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:roles,name',

            'slug' => 'required|string|max:50',

            'permissions' => 'required|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required.',
            'name.unique' => 'This role already exists.',

            'permissions.required' => 'Please select at least one permission.',
            'permissions.*.exists' => 'Invalid permission selected.',
        ];
    }
}
