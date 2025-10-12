<?php

namespace App\Modules\AccountGroup\Services;

use App\Modules\AccountGroup\Contracts\AccountGroupServiceInterface;
use App\Modules\AccountGroup\Models\AccountGroup;
use Illuminate\Database\Eloquent\Collection;

class AccountGroupService implements AccountGroupServiceInterface
{
    protected $resource = ['account_nature'];
    public function getAll(): Collection
    {
        $data = AccountGroup::with($this->resource)->get();
        //dd($data);
        return $data;
    }


    public function getById(int $id): ?AccountGroup
    {
        //dd(AccountGroup::findOrFail($id));
        return AccountGroup::findOrFail($id);
    }

    public function store(array $data): AccountGroup
    {
        return AccountGroup::create($data);
    }

    public function update(array $data, int $id): AccountGroup
    {

        $record = AccountGroup::findOrFail($id);
        $record->update($data);

        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountGroup::findOrFail($id);
        return $record->delete();
    }

    public function getCurrentLiabilityGroups(): Collection
    {
        $data = AccountGroup::with($this->resource)
            ->where('id', 20002)
            ->orWhere('parent_id', 20002)
            ->orderBy('name')->get();
        //dd($data);
        return $data;
    }
}
