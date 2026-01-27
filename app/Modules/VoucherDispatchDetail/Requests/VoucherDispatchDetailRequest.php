<?php

namespace App\Modules\VoucherDispatchDetail\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherDispatchDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'voucher_id' => ['required', 'numeric', 'exists:vouchers,id'],
            'order_number' => ['sometimes', 'nullable', 'string', 'max:255'],
            'payment_terms' => ['sometimes', 'nullable', 'string', 'max:255'],
            'other_references' => ['sometimes', 'nullable', 'string', 'max:255'],
            'terms_of_delivery' => ['sometimes', 'nullable', 'string', 'max:255'],
            'receipt_doc_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'dispatched_through' => ['sometimes', 'nullable', 'string', 'max:255'],
            'source' => ['sometimes', 'nullable', 'string', 'max:255'],
            'destination' => ['sometimes', 'nullable', 'string', 'max:255'],
            'destination_secondary' => ['sometimes', 'nullable', 'string', 'max:255'],
            'billing_preference' => ['sometimes', 'nullable', 'string', 'max:255'],
            'carrier_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bill_of_lading_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bill_of_lading_date' => ['sometimes', 'nullable', 'date'],
            'motor_vehicle_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'distance' => ['sometimes', 'nullable', 'numeric'],
            'distance_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'rate' => ['sometimes', 'nullable', 'numeric'],
            'rate_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'quantity' => ['sometimes', 'nullable', 'numeric'],
            'weight' => ['sometimes', 'nullable', 'numeric'],
            'weight_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'volume' => ['sometimes', 'nullable', 'numeric'],
            'volume_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'freight_basis' => ['sometimes', 'nullable', 'string'],
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
            $rules['id'] = ['sometimes', 'required', 'numeric', 'exists:voucher_dispatch_details,id'];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [
        ];
    }
}
