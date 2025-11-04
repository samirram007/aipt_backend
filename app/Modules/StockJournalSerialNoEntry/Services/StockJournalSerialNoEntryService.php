<?php

namespace App\Modules\StockJournalSerialNoEntry\Services;

use App\Modules\StockJournalSerialNoEntry\Contracts\StockJournalSerialNoEntryServiceInterface;
use App\Modules\StockJournalSerialNoEntry\Models\StockJournalSerialNoEntry;
use Illuminate\Database\Eloquent\Collection;

class StockJournalSerialNoEntryService implements StockJournalSerialNoEntryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalSerialNoEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalSerialNoEntry
    {
        return StockJournalSerialNoEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalSerialNoEntry
    {
        return StockJournalSerialNoEntry::create($data);
    }

    public function update(array $data, int $id): StockJournalSerialNoEntry
    {
        $record = StockJournalSerialNoEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalSerialNoEntry::findOrFail($id);
        return $record->delete();
    }
}
