<?php

namespace App\Modules\FiscalYear\Requests;

use App\Enums\ActiveInactive;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'name' => ['required', 'string', 'max:255', 'unique:fiscal_years,name'],
            'start_date' => ['required', 'date'],
            'end_date' => ['sometimes', 'required', 'date', 'after:start_date'],
            'company_id' => ['sometimes', 'required', 'numeric', 'exists:companies,id'],
            'status' => ['required', Rule::enum(ActiveInactive::class)],
            'assessment_year' => ['sometimes', 'string']
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('fiscal_year');

            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:fiscal_years,name,' . $id,];


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

            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
