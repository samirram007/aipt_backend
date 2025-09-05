<?php

namespace App\Modules\AccountNature\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\AccountGroup\Resources\AccountGroupCollection;
use App\Modules\AccountLedger\Resources\AccountLedgerCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="AccountNatureResource",
 *     title="Account Nature Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Example Account Nature"),
 *     @OA\Property(property="code", type="string", example="EXAMPLE"),
 *     @OA\Property(property="description", type="string", example="This is an example account nature."),
 *     @OA\Property(property="account_groups", type="array", @OA\Items(ref="#/components/schemas/AccountGroupResource")),
 *     @OA\Property(property="account_ledgers", type="array", @OA\Items(ref="#/components/schemas/AccountLedgerResource")),
 * )
 */
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
