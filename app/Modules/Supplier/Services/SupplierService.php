<?php

namespace App\Modules\Supplier\Services;

use App\Enums\AddressType;
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

        $supplier = Supplier::create($data);

        if ($data['address']) {

            // $data['address']['address_type'] = AddressType::Office->value;
            $data['address']['addressable_type'] = 'supplier';
            $data['address']['addressable_id'] = $supplier->id;
            // dd($data['address']);
            $supplier->address()->create($data['address']);
        }
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
