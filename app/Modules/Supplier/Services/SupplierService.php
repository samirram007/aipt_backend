<?php

namespace App\Modules\Supplier\Services;

use App\Modules\Supplier\Contracts\SupplierServiceInterface;
use App\Modules\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierService implements SupplierServiceInterface
{
    protected $resource = ['account_ledger', 'address'];

    public function getAll(): Collection
    {
        return Supplier::with($this->resource)->get();
    }

    public function getById(int $id): ?Supplier
    {
        return Supplier::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update(array $data, int $id): Supplier
    {
        $record = Supplier::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Supplier::findOrFail($id);
        return $record->delete();
    }
}
