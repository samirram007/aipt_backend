<?php

namespace App\Modules\VoucherEntry\Resources;

use App\Modules\AccountLedger\Resources\AccountLedgerResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherEntryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherId' => $this->voucher_id,
            'entryOrder' => $this->entry_order,
            'accountLedgerId' => $this->account_ledger_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'remarks' => $this->description,
            'accountLedger' => AccountLedgerResource::make($this->whenLoaded('account_ledger'))
        ];
    }
}
