<?php

namespace App\Modules\StockJournal\Resources;

use App\Modules\StockJournalEntry\Resources\StockJournalEntryResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'journalNo' => $this->journal_no,
            'journalDate' => $this->journal_date,
            'voucherId' => $this->voucher_id,
            'type' => $this->type,
            'remarks' => $this->remarks,
            'stockJournalEntries' => StockJournalEntryResource::collection($this->whenLoaded('stock_journal_entries')),
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
