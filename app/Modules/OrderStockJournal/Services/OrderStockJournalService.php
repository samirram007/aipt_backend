<?php

namespace App\Modules\OrderStockJournal\Services;

use App\Modules\OrderStockJournal\Contracts\OrderStockJournalServiceInterface;
use App\Modules\OrderStockJournal\Models\OrderStockJournal;
use Illuminate\Database\Eloquent\Collection;

class OrderStockJournalService implements OrderStockJournalServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return OrderStockJournal::with($this->resource)->get();
    }

    public function getById(int $id): ?OrderStockJournal
    {
        return OrderStockJournal::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): OrderStockJournal
    {
        return OrderStockJournal::create($data);
    }

    public function update(array $data, int $id): OrderStockJournal
    {
        $record = OrderStockJournal::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = OrderStockJournal::findOrFail($id);
        return $record->delete();
    }
}
