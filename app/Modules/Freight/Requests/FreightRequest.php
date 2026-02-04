<?php

namespace App\Modules\Freight\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'delivery_note_id' => ['required', 'numeric', 'exists:vouchers,id'],
            'distance' => ['sometimes', 'nullable', 'numeric'],
            'rate' => ['sometimes', 'nullable', 'numeric'],
            'distance_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'rate_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'quantity' => ['sometimes', 'nullable', 'numeric'],
            'weight' => ['sometimes', 'nullable', 'numeric'],
            'volume' => ['sometimes', 'nullable', 'numeric'],
            'loading_charges' => ['sometimes', 'nullable', 'numeric'],
            'unloading_charges' => ['sometimes', 'nullable', 'numeric'],
            'packing_charges' => ['sometimes', 'nullable', 'numeric'],
            'insurance_charges' => ['sometimes', 'nullable', 'numeric'],
            'other_charges' => ['sometimes', 'nullable', 'numeric'],
            'freight_charges' => ['sometimes', 'nullable', 'numeric'],
            'total_fare' => ['sometimes', 'nullable', 'numeric'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        }

        return $rules;
    }

    public function messages(): array
    {
        return [];
    }
}
