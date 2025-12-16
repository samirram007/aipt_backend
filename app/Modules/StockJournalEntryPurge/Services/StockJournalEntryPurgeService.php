<?php

namespace App\Modules\StockJournalEntryPurge\Services;

use App\Modules\StockJournalEntryPurge\Contracts\StockJournalEntryPurgeServiceInterface;
use App\Modules\StockJournalEntryPurge\Models\StockJournalEntryPurge;
use Illuminate\Database\Eloquent\Collection;

class StockJournalEntryPurgeService implements StockJournalEntryPurgeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalEntryPurge::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalEntryPurge
    {
        return StockJournalEntryPurge::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalEntryPurge
    {
        return StockJournalEntryPurge::create($data);
    }

    public function update(array $data, int $id): StockJournalEntryPurge
    {
        $record = StockJournalEntryPurge::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalEntryPurge::findOrFail($id);
        return $record->delete();
    }
}
