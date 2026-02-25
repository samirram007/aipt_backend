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
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'date'],
            'current_date' => ['sometimes', 'date'],
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
            'user_id.required' => 'The user ID is required.',
            'user_id.numeric' => 'The user ID must be a number.',
            'user_id.exists' => 'The selected user ID does not exist.',
            'fiscal_year_id.required' => 'The fiscal year ID is required.',
            'fiscal_year_id.numeric' => 'The fiscal year ID must be a number.',
            'fiscal_year_id.exists' => 'The selected fiscal year ID does not exist.',
        ];
    }
}
