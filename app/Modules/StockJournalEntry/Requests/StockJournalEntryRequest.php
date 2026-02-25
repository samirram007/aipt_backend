<?php

namespace App\Modules\StockJournalEntry\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockJournalEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'stock_journal_id' => ['required', 'numeric', 'exists:stock_journals,id'],
            'stock_item_id' => ['required', 'numeric', 'exists:stock_items,id'],
            'stock_unit_id' => ['required', 'numeric', 'exists:stock_units,id'],
            'alternate_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'unit_ratio' => ['sometimes', 'numeric'],
            'item_cost' => ['required', 'numeric'],
            'order_quantity' => ['required', 'numeric'],
            'actual_quantity' => ['required', 'numeric'],
            'billing_quantity' => ['required', 'numeric'],
            'rate' => ['required', 'numeric'],
            'rate_unit_id' => ['required', 'numeric', 'exists:stock_units,id'],
            'discount_percentage' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'movement_type' => ['required', 'string', 'max:255'],
            'stock_journal_godown_entries' => ['sometimes', 'nullable', 'array'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {

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
