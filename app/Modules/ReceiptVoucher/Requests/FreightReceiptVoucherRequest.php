<?php

namespace App\Modules\ReceiptVoucher\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreightReceiptVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'freight_id' => 'required|exists:vouchers,id',
            'payment_mode' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'receipt_date' => 'required|date',
            'remark' => 'sometimes|nullable|string|max:255',
            'party_ledger_id' => 'required|exists:account_ledgers,id',
            'transaction_ledger_id' => 'required|exists:account_ledgers,id',

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('freight_receipt_voucher');

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
