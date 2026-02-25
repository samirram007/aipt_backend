<?php

namespace App\Modules\StockJournalGodownEntry\Resources;

use App\Modules\Godown\Resources\GodownResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalGodownEntryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalEntryId' => $this->stock_journal_entry_id,
            'godownId' => $this->godown_id,
            'batchNo' => $this->batch_no,
            'mfgDate' => $this->mfg_date,
            'expiryDate' => $this->expiry_date,
            'serialNo' => $this->serial_no,
            'actualQuantity' => $this->actual_quantity,
            'billingQuantity' => $this->billing_quantity,
            'rate' => $this->rate,
            'discountPercentage' => $this->discount_percentage,
            'discount' => $this->discount,
            'amount' => $this->amount,
            'movementType' => $this->movement_type,
            'remarks' => $this->remarks,
            'godown' => GodownResource::make($this->whenLoaded('godown')),
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),

        ];
    }
}
