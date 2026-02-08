<?php

namespace App\Modules\Bom\Services;

use App\Modules\Bom\Contracts\BomServiceInterface;
use App\Modules\Bom\Models\Bom;
use App\Modules\BomDetail\Models\BomDetail;
use Illuminate\Database\Eloquent\Collection;

class BomService implements BomServiceInterface
{
    protected $resource=['details.stockItem','stockItem'];

    public function getAll(): Collection
    {
        return Bom::with($this->resource)->get();
    }

    public function getById(int $id): ?Bom
    {
        return Bom::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Bom
    {
       return Bom::create($data);
    }

    public function update(array $data, int $id): Bom
    {
        $record = Bom::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Bom::findOrFail($id);
        return $record->delete();
    }

    public function getBomByStockItemId(int $stockItemId): Collection
    {
        $data = Bom::with($this->resource)->where('stock_item_id',$stockItemId)->get();
        return $data;
    }
}
