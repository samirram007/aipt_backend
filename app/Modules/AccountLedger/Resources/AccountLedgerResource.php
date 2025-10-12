<?php

namespace App\Modules\AccountLedger\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\AccountGroup\Resources\AccountGroupResource;
use App\Modules\AccountNature\Resources\AccountNatureResource;
use Illuminate\Http\Request;
use App\Traits\HasPolymorphicResource;
/**
 * @OA\Schema(
 * schema="AccountLedgerResource",
 * title="AccountLedgerResource",
 * description="AccountLedgerResource",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Account Group Name"),
 * @OA\Property(property="code", type="string", example="AG001"),
 * @OA\Property(property="accountNatureId", type="integer", example=1),
 * @OA\Property(property="accountNature", type="object", ref="#/components/schemas/AccountNatureResource"),
 * @OA\Property(property="description", type="string", example="Account Group Description"),
 * @OA\Property(property="status", type="string", example="Active"),
 * @OA\Property(property="icon", type="string", example="fa fa-user"),
 *)
 */
class AccountLedgerResource extends SuccessResource
{
    use HasPolymorphicResource;
    public function toArray(Request $request): array
    {
        //dd($this->resolveResource($this->ledgerable)::class);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'status' => $this->status,
            'icon' => $this->icon,
            'accountGroupId' => $this->account_group_id,
            'accountGroup' => new AccountGroupResource($this->whenLoaded('account_group')),
            'accountNature' => new AccountNatureResource($this->whenLoaded('account_nature')),
            'ledgerableId' => $this->whenNotNull($this->ledgerable_id),
            'ledgerableType' => $this->whenNotNull($this->ledgerable_type),

            'ledgerable' => $this->whenLoaded(
                'ledgerable',
                fn() => $this->resolveResource($this->ledgerable)
            ),
            // 'accountGroupId' => $this->account_group_id,
            // 'accountGroup' => $this->whenLoaded('account_group', fn() => $this->resolveRelations($this->account_group, ['account_nature'])),
            // 'accountNature' => $this->whenLoaded('account_nature', fn() => $this->resolveResource($this->account_nature)),
            // 'ledgerable' => $this->whenLoaded('ledgerable', fn() => $this->resolveRelations($this->ledgerable, ['address' => fn($resolved) => $resolved instanceof \Illuminate\Database\Eloquent\Model ? $resolved->load(['state', 'country']) : $resolved])),
        ];
    }
}
