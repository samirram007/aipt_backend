<?php

namespace App\Modules\StockJournalGodownEntryPurge\Services;

use App\Modules\StockJournalGodownEntryPurge\Contracts\StockJournalGodownEntryPurgeServiceInterface;
use App\Modules\StockJournalGodownEntryPurge\Models\StockJournalGodownEntryPurge;
use Illuminate\Database\Eloquent\Collection;

class StockJournalGodownEntryPurgeService implements StockJournalGodownEntryPurgeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalGodownEntryPurge::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalGodownEntryPurge
    {
        return StockJournalGodownEntryPurge::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalGodownEntryPurge
    {
        return StockJournalGodownEntryPurge::create($data);
    }

    public function update(array $data, int $id): StockJournalGodownEntryPurge
    {
        $record = StockJournalGodownEntryPurge::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalGodownEntryPurge::findOrFail($id);
        return $record->delete();
    }
}
