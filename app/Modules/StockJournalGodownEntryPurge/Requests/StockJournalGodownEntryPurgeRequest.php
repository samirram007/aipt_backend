<?php

namespace App\Modules\StockJournalGodownEntryPurge\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockJournalGodownEntryPurgeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'stock_journal_godown_entry_id' => 'required|integer|exists:stock_journal_godown_entries,id',
            'purged_by' => 'sometimes|required|integer|exists:users,id',
            'purged_at' => 'sometimes|required|date',
            'reason' => 'sometimes|nullable|string|max:500',
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('stock_journal_godown_entry_purge');


        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'stock_journal_godown_entry_id.required' => 'The Stock Journal Godown Entry ID is required.',
            'stock_journal_godown_entry_id.integer' => 'The Stock Journal Godown Entry ID must be an integer.',
            'stock_journal_godown_entry_id.exists' => 'The specified Stock Journal Godown Entry does not exist.',
            'purged_by.required' => 'The Purged By field is required.',
            'purged_by.integer' => 'The Purged By field must be an integer.',
            'purged_by.exists' => 'The specified user for Purged By does not exist.',
            'purged_at.date' => 'The Purged At field must be a valid date.',
            'reason.string' => 'The Reason must be a string.',
            'reason.max' => 'The Reason may not be greater than 500 characters.',
        ];
    }
}
