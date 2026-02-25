<?php

namespace App\Modules\Voucher\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'voucher_no' => ['sometimes', 'required', 'string', 'max:255'],
            'voucher_date' => ['sometimes', 'required', 'date'],
            'reference_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'reference_date' => ['sometimes', 'nullable', 'date'],
            'voucher_type_id' => ['sometimes', 'required', 'numeric', 'exists:voucher_types,id'],
            'voucher_class_id' => ['sometimes', 'nullable', 'numeric', 'exists:voucher_classifications,id'],
            'module' => ['sometimes', 'nullable', 'string', 'max:255'],
            'remarks' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'fiscal_year_id' => ['sometimes', 'required', 'numeric', 'exists:fiscal_years,id'],
            'company_id' => ['sometimes', 'required', 'numeric', 'exists:companies,id'],
            'stock_journal_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_journals,id'],
            'stock_journal' => ['sometimes', 'nullable', 'array'],
            'voucher_entries' => ['sometimes', 'nullable', 'array'],
            'party_ledger' => ['sometimes', 'nullable', 'array'],
            'transaction_ledger' => ['sometimes', 'nullable', 'array'],
            'party' => ['sometimes', 'nullable', 'array'],
            'voucher_dispatch_detail' => ['sometimes', 'nullable', 'array'],
            'voucher_reference' => ['sometimes', 'nullable', 'array'],
            'is_effecting' => ['sometimes', 'nullable', 'boolean'],
            'is_optional' => ['sometimes', 'nullable', 'boolean'],
            'effects_account' => ['sometimes', 'nullable', 'boolean'],
            'effects_stock' => ['sometimes', 'nullable', 'boolean'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['id'] = ['sometimes', 'required', 'numeric', 'exists:vouchers,id'];
            // $rules['name'] = ['sometimes', 'required', 'string', 'max:255'];
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
