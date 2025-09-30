<?php

namespace App\Modules\StockItemSerial\Services;

use App\Modules\StockItemSerial\Contracts\StockItemSerialServiceInterface;
use App\Modules\StockItemSerial\Models\StockItemSerial;
use Illuminate\Database\Eloquent\Collection;

class StockItemSerialService implements StockItemSerialServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockItemSerial::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItemSerial
    {
        return StockItemSerial::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItemSerial
    {
        return StockItemSerial::create($data);
    }

    public function update(array $data, int $id): StockItemSerial
    {
        $record = StockItemSerial::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItemSerial::findOrFail($id);
        return $record->delete();
    }
}
