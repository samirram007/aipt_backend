<?php

namespace App\Modules\StockJournalGodownEntry\Services;

use App\Modules\StockJournalGodownEntry\Contracts\StockJournalGodownEntryServiceInterface;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;
use Illuminate\Database\Eloquent\Collection;

class StockJournalGodownEntryService implements StockJournalGodownEntryServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return StockJournalGodownEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalGodownEntry
    {
        return StockJournalGodownEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalGodownEntry
    {
        try {
            //code...
            $stockJournalGodownEntry = StockJournalGodownEntry::create($data);
        } catch (\Throwable $th) {

            throw $th;
        }


        return $stockJournalGodownEntry;
    }

    public function update(array $data, int $id): StockJournalGodownEntry
    {
        $record = StockJournalGodownEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalGodownEntry::findOrFail($id);
        return $record->delete();
    }
}
