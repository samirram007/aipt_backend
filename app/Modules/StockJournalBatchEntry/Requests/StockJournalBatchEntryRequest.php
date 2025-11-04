<?php

namespace App\Modules\StockJournalBatchEntry\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockJournalBatchEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'stock_journal_entry_id' => ['sometimes', 'required', 'numeric', 'exists:stock_journal_entries,id'],
            'stock_journal_godown_entry_id' => ['sometimes', 'required', 'numeric', 'exists:stock_journal_godown_entries,id'],
            'movement_type' => ['required', 'in:in,out'],
            'batch_no' => ['sometimes', 'required', 'string', 'max:255'],
            'serial_no' => ['sometimes', 'required', 'string', 'max:255'],
            'mfg_date' => ['sometimes', 'required', 'date'],
            'expiry_date' => ['sometimes', 'required', 'date'],
            'quantity' => ['required', 'numeric', 'min:0.0001'],
            'rate' => ['nullable', 'numeric', 'min:0'],
            'amount' => ['nullable', 'numeric', 'min:0'],
        ];


        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('stock_journal_batch_entry');

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
