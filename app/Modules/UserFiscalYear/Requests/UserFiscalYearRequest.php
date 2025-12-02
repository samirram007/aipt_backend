<?php

namespace App\Modules\UserFiscalYear\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFiscalYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'user_id' => ['sometimes', 'numeric', 'exists:users,id'],
            'fiscal_year_id' => ['sometimes', 'required', 'numeric', 'exists:fiscal_years,id'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('user_fiscal_year');
            $rules['user_id'] = ['sometimes', 'required', 'numeric', 'unique:user_fiscal_years,user_id,' . $id,];
            $rules['fiscal_year_id'] = ['sometimes', 'required', 'numeric', 'unique:user_fiscal_years,fiscal_year_id,' . $id,];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'code.unique' => 'The code has already been taken.',
            'description.required   ' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
