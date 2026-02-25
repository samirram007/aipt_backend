<?php

namespace App\Modules\Journal\Services;

use App\Modules\Journal\Contracts\JournalServiceInterface;
use App\Modules\Journal\Models\Journal;
use Illuminate\Database\Eloquent\Collection;

class JournalService implements JournalServiceInterface
{
    public function getAll(): Collection
    {
        return Journal::all();
    }

    public function getById(int $id): Journal
    {
        return Journal::findOrFail($id);
    }

    public function store(array $data): Journal
    {
        return Journal::create($data);
    }

    public function update(array $data, int $id): Journal
    {
        $record = Journal::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Journal::findOrFail($id);
        return $record->delete();
    }
}
