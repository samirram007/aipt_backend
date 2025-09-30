<?php

namespace App\Modules\StockJournal\Services;

use App\Modules\StockJournal\Contracts\StockJournalServiceInterface;
use App\Modules\StockJournal\Models\StockJournal;
use Illuminate\Database\Eloquent\Collection;

class StockJournalService implements StockJournalServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockJournal::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournal
    {
        return StockJournal::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournal
    {
        return StockJournal::create($data);
    }

    public function update(array $data, int $id): StockJournal
    {
        $record = StockJournal::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockJournal::findOrFail($id);
        return $record->delete();
    }
}
