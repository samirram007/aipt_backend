<?php

namespace App\Modules\JobOrderHistory\Services;

use App\Modules\JobOrderHistory\Contracts\JobOrderHistoryServiceInterface;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;
use Illuminate\Database\Eloquent\Collection;

class JobOrderHistoryService implements JobOrderHistoryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return JobOrderHistory::with($this->resource)->get();
    }

    public function getById(int $id): ?JobOrderHistory
    {
        return JobOrderHistory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): JobOrderHistory
    {
        return JobOrderHistory::create($data);
    }

    public function update(array $data, int $id): JobOrderHistory
    {
        $record = JobOrderHistory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = JobOrderHistory::findOrFail($id);
        return $record->delete();
    }
}
