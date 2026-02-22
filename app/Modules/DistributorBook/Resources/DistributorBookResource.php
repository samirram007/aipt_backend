<?php

namespace App\Modules\DistributorBook\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DistributorBookResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "debit" => $this->debit,
            "credit" => $this->credit,
            "balance" => $this->net_balance,

        ];
    }
}
