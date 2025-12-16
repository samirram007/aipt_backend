<?php

namespace App\Modules\StockJournalEntryPurge\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalEntryPurgeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalEntryId' => $this->stock_journal_entry_id,
            'purgedBy' => $this->purged_by,
            'purgedAt' => $this->purged_at,
            'reason' => $this->reason,
        ];
    }
}
