<?php

namespace App\Modules\StockJournalGodownEntryPurge\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalGodownEntryPurgeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalGodownEntryId' => $this->stock_journal_godown_entry_id,
            'purgedBy' => $this->purged_by,
            'purgedAt' => $this->purged_at,
            'reason' => $this->reason,
        ];
    }
}
