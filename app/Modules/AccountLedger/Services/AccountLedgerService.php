<?php

namespace App\Modules\AccountLedger\Services;

use App\Modules\AccountLedger\Contracts\AccountLedgerServiceInterface;
use App\Modules\AccountLedger\Models\AccountLedger;
use Illuminate\Database\Eloquent\Collection;

class AccountLedgerService implements AccountLedgerServiceInterface
{

    protected $resource = [
        'account_group.account_nature',
        'ledgerable.address.state',
        'ledgerable.address.country'
    ];
    // /**
    //  * Define the resources and their relations to be resolved
    //  *
    //  * @var array<string|array<string,callable>>
    //  */
    // protected $resource = [
    //     'account_group.account_nature', // Simple nested relation
    //     'ledgerable.address' => fn($resolved) => $resolved instanceof \Illuminate\Database\Eloquent\Model
    //         ? $resolved->load(['state', 'country'])
    //         : $resolved, // Transform resolved resource
    // ];
    public function getAll(): Collection
    {
        return AccountLedger::with($this->resource)->get();
    }

    public function getById(int $id): AccountLedger
    {
        return AccountLedger::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AccountLedger
    {
        return AccountLedger::create($data);
    }

    public function update(array $data, int $id): AccountLedger
    {
        // dd($data);
        $record = AccountLedger::findOrFail($id);

        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountLedger::findOrFail($id);
        return $record->delete();
    }
}
