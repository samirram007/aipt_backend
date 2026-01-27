<?php

namespace App\Modules\StockJournalStorageUnitEntry\Services;

use App\Modules\StockJournalStorageUnitEntry\Contracts\StockJournalStorageUnitEntryServiceInterface;
use App\Modules\StockJournalStorageUnitEntry\Models\StockJournalStorageUnitEntry;
use Illuminate\Database\Eloquent\Collection;

class StockJournalStorageUnitEntryService implements StockJournalStorageUnitEntryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalStorageUnitEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalStorageUnitEntry
    {
        return StockJournalStorageUnitEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalStorageUnitEntry
    {
        return StockJournalStorageUnitEntry::create($data);
    }

    public function update(array $data, int $id): StockJournalStorageUnitEntry
    {
        $record = StockJournalStorageUnitEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalStorageUnitEntry::findOrFail($id);
        return $record->delete();
    }
}
