<?php

namespace App\Modules\StockJournalBatchEntry\Services;

use App\Modules\StockJournalBatchEntry\Contracts\StockJournalBatchEntryServiceInterface;
use App\Modules\StockJournalBatchEntry\Models\StockJournalBatchEntry;
use Illuminate\Database\Eloquent\Collection;

class StockJournalBatchEntryService implements StockJournalBatchEntryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalBatchEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalBatchEntry
    {
        return StockJournalBatchEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalBatchEntry
    {
        return StockJournalBatchEntry::create($data);
    }

    public function update(array $data, int $id): StockJournalBatchEntry
    {
        $record = StockJournalBatchEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalBatchEntry::findOrFail($id);
        return $record->delete();
    }
}
