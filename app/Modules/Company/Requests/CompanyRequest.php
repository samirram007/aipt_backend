<?php

namespace App\Modules\Company\Requests;


use App\Modules\Address\Requests\AddressRequest;
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
            'name' => ['required', 'string', 'max:255', 'unique:companies,name'],
            'code' => ['sometimes', 'nullable', 'string', 'max:255'],
            'mailing_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'phone_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'mobile_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255'],
            'website' => ['sometimes', 'nullable', 'string', 'max:255'],
            'company_type_id' => ['required', 'integer', 'exists:company_types,id'],
            'cin_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'tin_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'tan_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'gst_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'pan_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'logo' => ['sometimes', 'nullable', 'string', 'max:255'],
            'currency_id' => ['sometimes', 'nullable',  'exists:currencies,id'],
            'status' => ['nullable', 'string', 'max:255'],
            'is_group_company' => ['sometimes', 'nullable', 'boolean'],
            'children' => ['nullable', 'string']
        ];

        $addressRules = collect((new AddressRequest())->rules())
            ->mapWithKeys(fn($rule, $key) => ["address.$key" => $rule])
            ->toArray();

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('companies');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:companies,name,' . $id];

        }
        return array_merge($rules, $addressRules);
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
