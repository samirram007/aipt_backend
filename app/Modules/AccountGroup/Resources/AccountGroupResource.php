<?php

namespace App\Modules\AccountGroup\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\AccountLedger\Resources\AccountLedgerCollection;
use App\Modules\AccountNature\Resources\AccountNatureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 * schema="AccountGroupResource",
 * title="AccountGroupResource",
 * description="AccountGroupResource",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Account Group Name"),
 * @OA\Property(property="code", type="string", example="AG001"),
 * @OA\Property(property="accountNatureId", type="integer", example=1),
 * @OA\Property(property="accountNature", type="object", ref="#/components/schemas/AccountNatureResource"),
 * @OA\Property(property="accountLedgers", type="array", @OA\Items(ref="#/components/schemas/AccountLedgerResource")),
 * @OA\Property(property="description", type="string", example="Account Group Description"),
 * @OA\Property(property="status", type="string", example="Active"),
 * @OA\Property(property="icon", type="string", example="fa fa-user"),
 *)
 */
class AccountGroupResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'accountNatureId' => $this->account_nature_id,
            'accountNature' => new AccountNatureResource($this->whenLoaded('account_nature')),
            'accountLedgers' => new AccountLedgerCollection($this->whenLoaded('account_ledgers')),

        ];
    }
}
