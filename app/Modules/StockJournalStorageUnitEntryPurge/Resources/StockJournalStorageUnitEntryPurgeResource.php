<?php

namespace App\Modules\StockJournalStorageUnitEntryPurge\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockJournalStorageUnitEntryPurgeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
