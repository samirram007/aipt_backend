<?php

namespace App\Modules\JobOrder\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'stock_journal_id' => ['sometimes','required','numeric', 'exists:stock_journals,id'],
            'stock_journal_entry_id' => ['required','numeric', 'exists:stock_journal_entries,id'],
            'stock_item_id' => ['required','numeric', 'exists:stock_items,id'],
            'status' => ['required', 'string', 'max:255'],
            'start_date' => ['sometimes','required','date'],
            'end_date' => ['sometimes','required','date'],
            'voucher_id' => ['required', 'numeric', 'exists:vouchers,id'],
        ];

        // If updating (PUT/PATCH), make some rules optional
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['patient_id'][0] = 'sometimes';
            $rules['voucher_id'][0] = 'sometimes';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'patient_id.required' => 'Please select a valid patient.',
            'patient_id.exists' => 'The selected patient does not exist.',

            'voucher_id.required' => 'Please select a valid voucher.',
            'voucher_id.exists' => 'The selected voucher does not exist.',

            'employee_id.exists' => 'The selected employee does not exist.',

            'status.in' => 'Invalid status value.',
            'payment_status.in' => 'Invalid payment status value.',
            'priority.in' => 'Invalid priority value.',

            'booked_date.date' => 'The booked date must be a valid date.',
            'expected_delivery_date.date' => 'The expected delivery date must be a valid date.',
            'report_generated_date.date' => 'The report generated date must be a valid date.',
            'report_delivered_date.date' => 'The report delivered date must be a valid date.',
            'cancelled_date.date' => 'The cancelled date must be a valid date.',
        ];
    }
}
