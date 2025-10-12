<?php

namespace App\Modules\StockItemGodown\Services;

use App\Modules\StockItemGodown\Contracts\StockItemGodownServiceInterface;
use App\Modules\StockItemGodown\Models\StockItemGodown;
use Illuminate\Database\Eloquent\Collection;

class StockItemGodownService implements StockItemGodownServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockItemGodown::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItemGodown
    {
        return StockItemGodown::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItemGodown
    {
        return StockItemGodown::create($data);
    }

    public function update(array $data, int $id): StockItemGodown
    {
        $record = StockItemGodown::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItemGodown::findOrFail($id);
        return $record->delete();
    }
}
