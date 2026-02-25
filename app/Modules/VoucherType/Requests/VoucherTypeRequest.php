<?php

namespace App\Modules\VoucherType\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:voucher_types,name'],
            'code' => ['sometimes'],
            'voucher_category_id' => ['sometimes', 'nullable', 'numeric', 'exists:voucher_categories,id'],
            'description' => ['sometimes'],
            'status' => ['sometimes'],
            'icon' => ['sometimes'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('voucher_type');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:voucher_types,name,' . $id];
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
