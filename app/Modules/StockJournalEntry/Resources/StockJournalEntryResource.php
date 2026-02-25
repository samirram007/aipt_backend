<?php

namespace App\Modules\StockJournalEntry\Resources;

use App\Modules\StockItem\Resources\StockItemResource;
use App\Modules\StockJournal\Resources\StockJournalResource;
use App\Modules\StockJournalGodownEntry\Resources\StockJournalGodownEntryResource;
use App\Modules\StockUnit\Resources\StockUnitResource;
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
            'orderQuantity' => $this->order_quantity,
            'actualQuantity' => $this->actual_quantity,
            'billingQuantity' => $this->billing_quantity,
            'rate' => $this->rate,
            'rateUnitId' => $this->rate_unit_id,
            'rateUnitRatio' => $this->rate_unit_ratio,
            'discountPercentage' => $this->discount_percentage,
            'discount' => $this->discount,
            'amount' => $this->amount,
            'movementType' => $this->movement_type,
            'rateUnit' => StockUnitResource::make($this->whenLoaded('rate_unit')),
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
            'stockJournalGodownEntries' => StockJournalGodownEntryResource::collection($this->whenLoaded('stock_journal_godown_entries')),
            'stockJournal' => StockJournalResource::make($this->whenLoaded('stock_journal')),
            'stockItem' => StockItemResource::make($this->whenLoaded('stock_item')),
            'stockUnit' => StockUnitResource::make($this->whenLoaded('stock_unit')),
            'alternateUnit' => StockUnitResource::make($this->whenLoaded('alternate_unit')),
            'stockInHand' => $this->stock_in_hand,

        ];
    }
}
