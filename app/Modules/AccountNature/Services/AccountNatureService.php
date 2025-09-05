<?php

namespace App\Modules\AccountNature\Services;

use App\Modules\AccountNature\Contracts\AccountNatureServiceInterface;
use App\Modules\AccountNature\Models\AccountNature;
use Illuminate\Database\Eloquent\Collection;

class AccountNatureService implements AccountNatureServiceInterface
{
    protected $resource=[];
    public function getAll(): Collection
    {
        return AccountNature::with($this->resource)->get();
    }

    public function getById(int $id): ?AccountNature
    {
        return AccountNature::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AccountNature
    {
        return AccountNature::create($data);
    }

    public function update(array $data, int $id): AccountNature
    {
        $record = AccountNature::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountNature::findOrFail($id);
        return $record->delete();
    }
}
