<?php

namespace App\Modules\Distributor\Services;

use App\Modules\Distributor\Contracts\DistributorServiceInterface;
use App\Modules\Distributor\Models\Distributor;
use Illuminate\Database\Eloquent\Collection;

class DistributorService implements DistributorServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Distributor::with($this->resource)->get();
    }

    public function getById(int $id): ?Distributor
    {
        return Distributor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Distributor
    {
        return Distributor::create($data);
    }

    public function update(array $data, int $id): Distributor
    {
        $record = Distributor::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Distributor::findOrFail($id);
        return $record->delete();
    }
}
