<?php

namespace App\Modules\Address\Services;

use App\Modules\Address\Contracts\AddressServiceInterface;
use App\Modules\Address\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressService implements AddressServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Address::with($this->resource)->get();
    }

    public function getById(int $id): ?Address
    {
        return Address::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Address
    {
        return Address::create($data);
    }

    public function update(array $data, int $id): Address
    {
        $record = Address::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Address::findOrFail($id);
        return $record->delete();
    }
}
