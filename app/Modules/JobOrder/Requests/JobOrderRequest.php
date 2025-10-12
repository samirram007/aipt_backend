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
            'patient_id' => ['required', 'numeric', 'exists:patients,id'],
            'voucher_id' => ['required', 'numeric', 'exists:vouchers,id'],
            'status' => ['sometimes', 'required', 'in:booked,sample_collected,in_process,completed,delivered,cancelled,drafted'],
            'payment_status' => ['sometimes', 'required', 'in:pending,partial,completed'],
            'priority' => ['sometimes', 'required', 'in:normal,urgent,critical'],
            'booked_date' => ['sometimes','nullable', 'date'],
            'expected_delivery_date' => ['sometimes','nullable', 'date'],
            'report_generated_date' => ['sometimes','nullable', 'date'],
            'report_delivered_date' => ['sometimes','nullable', 'date'],
            'cancelled_date' => ['sometimes','nullable', 'date'],
            'report_file_path' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string', 'max:255'],
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
