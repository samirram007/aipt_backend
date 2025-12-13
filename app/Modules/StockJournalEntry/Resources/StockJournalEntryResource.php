<?php

namespace App\Modules\StockJournalEntry\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\JobOrder\Resources\JobOrderResource;
use App\Modules\StockItem\Resources\StockItemResource;
use App\Modules\StockJournal\Resources\StockJournalResource;
use App\Modules\StockUnit\Resources\StockUnitResource;

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
            'testDate' => $this->start_date,
            'reportDate' => $this->end_date,
            'discountPercentage' => $this->discount_percentage,
            'discountValue' => $this->discount_value,
            'netDiscountedAmount' => $this->amount,
            'rate' => $this->rate,
            'movementType' => $this->movement_type,
            'godownId' => $this->godown_id,
            'isCancelled' => $this->is_cancelled,
            'isApproved' => $this->is_approved,
            'isRequested' => $this->is_requested,
            'stockJournal' => new StockJournalResource($this->whenLoaded('stock_journal')),
            'stockItem' => new StockItemResource($this->whenLoaded('stock_item')),
            'stockUnit' => new StockUnitResource($this->whenLoaded('stock_unit')),
            'jobOrder' => JobOrderResource::make($this->whenLoaded('job_order')),
        ];
    }
}
