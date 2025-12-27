<?php

namespace App\Modules\TestBooking\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestConfirmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'voucher_id' => ['required', 'numeric', 'exists:vouchers,id'],
            'voucher_type_id' => ['required', 'numeric', 'exists:voucher_types,id'],
            'amount' => ['required', 'numeric'],
            'patient_id' => ['required', 'numeric', 'exists:patients,id'],
            "payment_mode" => ['required', 'numeric', 'exists:account_ledgers,id'],
            'transaction_no' => ['sometimes', 'nullable', 'string', 'max:255']
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'stock_journal_id.required' => 'Stock Journal ID is required.',
            'stock_journal_id.numeric' => 'Stock Journal ID must be a number.',
            'stock_journal_id.exists' => 'The selected Stock Journal does not exist.',
            'voucher_id.required' => 'Voucher ID is required.',
            'voucher_id.numeric' => 'Voucher ID must be a number.',
            'voucher_id.exists' => 'The selected Voucher does not exist.',
            'paid_amount.required' => 'Paid Amount is required.',
            'paid_amount.numeric' => 'Paid Amount must be a number.',
            'patient_id.required' => 'Patient ID is required.',
            'patient_id.numeric' => 'Patient ID must be a number.',
            'patient_id.exists' => 'The selected Patient does not exist.',
        ];
    }
}
