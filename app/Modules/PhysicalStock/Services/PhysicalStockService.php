<?php

namespace App\Modules\PhysicalStock\Services;

use App\Modules\PhysicalStock\Contracts\PhysicalStockServiceInterface;
use App\Modules\PhysicalStock\Models\PhysicalStock;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class PhysicalStockService implements PhysicalStockServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return PhysicalStock::with($this->resource)->get();
    }

    public function getById(int $id): ?PhysicalStock
    {
        return PhysicalStock::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PhysicalStock
    {

        $stockJournal = StockJournal::create([]);
        $voucher = Voucher::create([
            ''
        ]);
        return PhysicalStock::create($data);
    }

    public function update(array $data, int $id): PhysicalStock
    {
        $record = PhysicalStock::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PhysicalStock::findOrFail($id);
        return $record->delete();
    }
}
