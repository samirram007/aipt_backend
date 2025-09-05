<?php

namespace App\Modules\FiscalYear\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="FiscalYearRequest",
 *     title="FiscalYear Request",
 *     @OA\Property(property="name", type="string", example="Fiscal Year 2025-26"),
 * @OA\Property(property="start_date", type="string", example="2025-04-01"),
 * @OA\Property(property="end_date", type="string", example="2026-03-31"),
 * )
 */

class FiscalYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255','unique:fiscal_years,name'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes','required', 'date', 'after:start_date'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:fiscal_years,name,' . $this->route('fiscal_year'),];


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
