<?php

namespace App\Modules\UserFiscalYear\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportingPeriodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('user_fiscal_year');

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
