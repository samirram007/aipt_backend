<?php

namespace App\Modules\TestCancellationRequest\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\StockJournalEntry\Resources\StockJournalEntryResource;

class TestCancellationRequestResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalEntryId' => $this->stock_journal_entry_id,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'stockJournalEntry' => StockJournalEntryResource::make($this->whenLoaded('stock_journal_entry')),
            'cancelledBy' => $this->cancelled_by,
            'requestedBy' => $this->requested_by,
            'approvedBy' => $this->approved_by
        ];
    }
}
