<?php

namespace App\Modules\StorageUnit\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:storage_units,name'],
            'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:storage_units,code'],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'icon' => ['sometimes', 'required', 'string', 'max:255'],
            'storage_unit_type' => ['required', 'string', 'max:255'],
            'storage_unit_category' => ['required', 'string', 'max:255'],
            'parent_id' => ['sometimes', 'nullable', 'integer', 'exists:storage_units,id'],
            'is_virtual' => ['sometimes', 'boolean'],
            'is_mobile' => ['sometimes', 'boolean'],
            'capacity_value' => ['sometimes', 'nullable', 'numeric'],
            'capacity_unit_id' => ['sometimes', 'nullable', 'integer', 'exists:stock_units,id'],
            'temperature_min' => ['sometimes', 'nullable', 'numeric'],
            'temperature_max' => ['sometimes', 'nullable', 'numeric'],
            'our_stock_with_third_party' => ['sometimes', 'boolean'],
            'third_party_stock_with_us' => ['sometimes', 'boolean'],

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('storage_unit');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:storage_units,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:storage_units,code,' . $id,];

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
