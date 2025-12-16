<?php

namespace App\Modules\AccountGroup\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:account_groups'],
            'code' => ['sometimes'],
            'account_nature_id' => ['sometimes', 'nullable', 'numeric', 'exists:account_natures,id'],
            'description' => ['sometimes'],
            'status' => ['sometimes'],
            'icon' => ['sometimes'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:account_groups,name,' . $this->route('account_group')];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
        ];
    }
}
