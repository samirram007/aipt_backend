<?php

namespace App\Modules\AccountNature\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountNatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:account_natures'],
            'code' => ['sometimes'],
            'description' => ['sometimes'],
            'accounting_effect' => ['sometimes'],
            'status' => ['sometimes'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:account_natures,name,' . $this->route('account_nature')];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'code.string' => 'The code must be a string.',
            'description.string' => 'The description must be a string.',

        ];
    }
}
