<?php

namespace App\Modules\StockJournal\Resources;

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
            'type'=> $this->type,
            'remarks' => $this->remarks,
        ];
    }
}
