<?php

namespace App\Modules\StockJournalEntry\Services;

use App\Modules\StockJournalEntry\Contracts\StockJournalEntryServiceInterface;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use Illuminate\Database\Eloquent\Collection;

class StockJournalEntryService implements StockJournalEntryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalEntry
    {
        return StockJournalEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalEntry
    {
        return StockJournalEntry::create($data);
    }

    public function update(array $data, int $id): StockJournalEntry
    {
        $record = StockJournalEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalEntry::findOrFail($id);
        return $record->delete();
    }
}
