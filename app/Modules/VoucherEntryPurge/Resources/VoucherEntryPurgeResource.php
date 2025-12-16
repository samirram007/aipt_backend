<?php

namespace App\Modules\VoucherEntryPurge\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherEntryPurgeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherEntryId' => $this->voucher_entry_id,
            'purgedBy' => $this->purged_by,
            'purgedAt' => $this->purged_at,
            'reason' => $this->reason,
        ];
    }
}
