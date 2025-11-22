<?php

namespace App\Modules\StockUnit\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:stock_units,name'],
            'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:stock_units,code'],
            'unit_type' => ['sometimes', 'required', 'string', 'max:255',],
            'quantity_type' => ['sometimes', 'required', 'string', 'max:255',],
            'unique_quantity_code_id' => ['sometimes', 'nullable', 'numeric', 'exists:unique_quantity_codes,id',],
            'primary_stock_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id',],
            'secondary_stock_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id',],
            'conversion_factor' => ['sometimes', 'nullable', 'numeric',],
            'no_of_decimal_places' => ['sometimes', 'nullable', 'numeric',],


        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_units,name,' . $this->route('stock_unit'),];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_units,code,' . $this->route('stock_unit'),];

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
