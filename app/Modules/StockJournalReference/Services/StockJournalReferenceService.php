<?php

namespace App\Modules\StockJournalReference\Services;

use App\Modules\StockJournalReference\Contracts\StockJournalReferenceServiceInterface;
use App\Modules\StockJournalReference\Models\StockJournalReference;
use Illuminate\Database\Eloquent\Collection;

class StockJournalReferenceService implements StockJournalReferenceServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournalReference::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalReference
    {
        return StockJournalReference::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalReference
    {
        return StockJournalReference::create($data);
    }

    public function update(array $data, int $id): StockJournalReference
    {
        $record = StockJournalReference::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalReference::findOrFail($id);
        return $record->delete();
    }
}
