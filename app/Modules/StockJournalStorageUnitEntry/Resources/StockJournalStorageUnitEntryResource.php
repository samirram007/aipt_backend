<?php

namespace App\Modules\StockJournalStorageUnitEntry\Resources;

use App\Modules\StorageUnit\Resources\StorageUnitResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalStorageUnitEntryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stockJournalEntryId' => $this->stock_journal_entry_id,
            'storageUnitId' => $this->storage_unit_id,
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
            'storageUnit' => StorageUnitResource::make($this->whenLoaded('storage_unit')),
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
