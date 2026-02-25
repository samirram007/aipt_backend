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

class TransactionLedgerResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        //dd($this);
        $data = [
            'id' => $this['id'],
            'name' => $this['name'],
            'code' => $this['code'],
            'accountGroupId' => $this['account_group_id'],
            'currentBalance' => $this['current_balance'],
        ];

        return $data;
    }
}
// function array_keys_to_camel_case(array $array): array
// {
//     return collect($array)->mapWithKeys(fn($value, $key) => [Str::camel($key) => $value])->all();
// }
