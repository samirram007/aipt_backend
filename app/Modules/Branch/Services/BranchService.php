<?php

namespace App\Modules\Branch\Services;

use App\Modules\Branch\Contracts\BranchServiceInterface;
use App\Modules\Branch\Models\Branch;
use Illuminate\Database\Eloquent\Collection;

class BranchService implements BranchServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Branch::with($this->resource)->get();
    }

    public function getById(int $id): ?Branch
    {
        return Branch::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Branch
    {
        return Branch::create($data);
    }

    public function update(array $data, int $id): Branch
    {
        $record = Branch::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Branch::findOrFail($id);
        return $record->delete();
    }
}
