<?php

namespace App\Modules\Currency\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['sometimes', 'required', 'string', 'max:255', 'unique:currencies,name'],
            'code' => ['sometimes', 'required', 'string', 'max:10', 'unique:currencies,code'],
            'symbol' => ['sometimes', 'nullable', 'string', 'max:5'],
            'country' => ['sometimes', 'nullable', 'string', 'max:255'],
            'exchange_rate' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'decimal_places' => ['sometimes', 'required', 'integer', 'min:0', 'max:6'],
            'status' => ['sometimes', 'required', 'string', Rule::in(['active', 'inactive'])],
            'format' => ['sometimes', 'nullable', 'string', 'max:20'],
            'thousands_separator' => ['sometimes', 'nullable', 'string', 'max:1'],
            'decimal_separator' => ['sometimes', 'nullable', 'string', 'max:1'],
            'symbol_position' => ['sometimes', 'required', 'string', Rule::in(['before', 'after'])],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('currency');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:currencies,name,' . $id];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:currencies,code,' . $id];

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
