<?php

namespace App\Modules\OrderJournal\Services;

use App\Modules\OrderJournal\Contracts\OrderJournalServiceInterface;
use App\Modules\OrderJournal\Models\OrderJournal;
use Illuminate\Database\Eloquent\Collection;

class OrderJournalService implements OrderJournalServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return OrderJournal::with($this->resource)->get();
    }

    public function getById(int $id): ?OrderJournal
    {
        return OrderJournal::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): OrderJournal
    {
        return OrderJournal::create($data);
    }

    public function update(array $data, int $id): OrderJournal
    {
        $record = OrderJournal::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = OrderJournal::findOrFail($id);
        return $record->delete();
    }
}
