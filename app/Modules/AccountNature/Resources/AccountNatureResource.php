<?php

namespace App\Modules\AccountNature\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\AccountGroup\Resources\AccountGroupCollection;
use App\Modules\AccountLedger\Resources\AccountLedgerCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



class AccountNatureResource extends SuccessResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'accountingEffect' => $this->accounting_effect,
            'status' => $this->status,
            'accountGroups' => new AccountGroupCollection($this->whenLoaded('account_groups')),
            'accountLedgers' => new AccountLedgerCollection($this->whenLoaded('account_ledgers')),
        ];
    }
}
