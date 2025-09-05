<?php

namespace App\Modules\Company\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CompanyRequest",
 *     title="Company Request",
 *     @OA\Property(property="name", type="string", example="Example Company"),
 *     @OA\Property(property="code", type="string", example="EXAMPLE"),
 *     @OA\Property(property="address", type="string", example="123 Main St"),
 * @OA\Property(property="phone", type="string", example="1234567890"),
 * @OA\Property(property="email", type="string", example="info@example.com"),
 * @OA\Property(property="website", type="string", example="www.example.com"),
 * @OA\Property(property="company_type_id", type="integer", example=1),
 * @OA\Property(property="fiscal_year_id", type="integer", example=1),
 * @OA\Property(property="tin", type="string", example="1234567890"),
 * @OA\Property(property="vat", type="string", example="1234567890"),
 * @OA\Property(property="logo", type="string", example="logo.png"),
 * @OA\Property(property="currency", type="string", example="INR"),
 * @OA\Property(property="country", type="string", example="IN"),
 * @OA\Property(property="state", type="string", example="Maharashtra"),
 * @OA\Property(property="city", type="string", example="Mumbai"),
 * @OA\Property(property="zip", type="string", example="400001"),
 * @OA\Property(property="status", type="string", example="active"),
 * )
 */
class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'company_type_id' => ['required', 'integer', 'exists:company_types,id'],
            'fiscal_year_id' => ['required', 'integer', 'exists:fiscal_years,id'],
            'tin' => ['nullable', 'string', 'max:255'],
            'vat' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'string', 'max:255'],
            'currency' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255'];
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
