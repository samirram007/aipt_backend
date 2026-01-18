<?php

namespace App\Modules\StockJournalStorageUnitEntryPurge\Services;

use App\Modules\StockJournalStorageUnitEntryPurge\Contracts\StockJournalStorageUnitEntryPurgeServiceInterface;
use App\Modules\StockJournalStorageUnitEntryPurge\Models\StockJournalStorageUnitEntryPurge;
use Illuminate\Database\Eloquent\Collection;

class StockJournalStorageUnitEntryPurgeService implements StockJournalStorageUnitEntryPurgeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalStorageUnitEntryPurge::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalStorageUnitEntryPurge
    {
        return StockJournalStorageUnitEntryPurge::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalStorageUnitEntryPurge
    {
        return StockJournalStorageUnitEntryPurge::create($data);
    }

    public function update(array $data, int $id): StockJournalStorageUnitEntryPurge
    {
        $record = StockJournalStorageUnitEntryPurge::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalStorageUnitEntryPurge::findOrFail($id);
        return $record->delete();
    }
}
