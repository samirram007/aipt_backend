<?php

namespace App\Modules\StockJournalEntry\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalEntryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalId' => $this->stock_journal_id,
            'stockItemId' => $this->stock_item_id,
            'stockUnitId' => $this->stock_unit_id,
            'alternateUnitId' => $this->alternate_unit_id,
            'unitRatio' => $this->unit_ratio,
            'itemCost' => $this->item_cost,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'movementType' => $this->movement_type,
            'godownId' => $this->godown_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
