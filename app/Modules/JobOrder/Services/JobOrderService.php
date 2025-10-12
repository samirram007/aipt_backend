<?php

namespace App\Modules\JobOrder\Services;

use App\Modules\JobOrder\Contracts\JobOrderServiceInterface;
use App\Modules\JobOrder\Models\JobOrder;
use Illuminate\Database\Eloquent\Collection;

class JobOrderService implements JobOrderServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return JobOrder::with($this->resource)->get();
    }

    public function getById(int $id): ?JobOrder
    {
        return JobOrder::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): JobOrder
    {
        return JobOrder::create($data);
    }

    public function update(array $data, int $id): JobOrder
    {
        $record = JobOrder::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = JobOrder::findOrFail($id);
        return $record->delete();
    }
}
