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
            'destination' => ['sometimes', 'nullable', 'string', 'max:255'],
            'carrier_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bill_of_lading_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'bill_of_lading_date' => ['sometimes', 'nullable', 'date'],
            'motor_vehicle_no' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('voucher_dispatch_detail');

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
