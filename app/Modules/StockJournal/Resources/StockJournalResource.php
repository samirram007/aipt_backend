<?php

namespace App\Modules\StockJournal\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\StockJournalEntry\Resources\StockJournalEntryResource;
use App\Modules\Voucher\Resources\VoucherResource;

class StockJournalResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'journalNo' => $this->journal_no,
            'journalDate' => $this->journal_date,
            'voucher' => VoucherResource::make($this->whenLoaded('voucher')),
            'type' => $this->type,
            'stockJournalEntries' => StockJournalEntryResource::collection($this->whenLoaded('stock_journal_entries')),
            'remarks' => $this->remarks,
        ];
    }
}
