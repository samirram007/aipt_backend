<?php

namespace App\Modules\Voucher\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\Company\Resources\CompanyResource;
use App\Modules\FiscalYear\Resources\FiscalYearResource;
use App\Modules\StockJournal\Resources\StockJournalResource;
use App\Modules\VoucherEntry\Resources\VoucherEntryResource;
use App\Modules\VoucherType\Resources\VoucherTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartyLedgerResource extends SuccessResource
{
    public function toArray(Request $request): array
    {

        $data = [
            'id' => $this['id'],
            'name' => $this['name'],
            'code' => $this['code'],
            'ledgerableId' => $this['ledgerable_id'],
            'ledgerableType' => $this['ledgerable_type'],
            'currentBalance' => $this['current_balance'],
        ];

        return $data;
    }
}
