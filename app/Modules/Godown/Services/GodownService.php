<?php

namespace App\Modules\Godown\Services;

use App\Modules\Godown\Contracts\GodownServiceInterface;
use App\Modules\Godown\Models\Godown;
use Illuminate\Database\Eloquent\Collection;

class GodownService implements GodownServiceInterface
{
    protected $resource = ['parent'];

    public function getAll(): Collection
    {
        return Godown::with($this->resource)->get();
    }

    public function getById(int $id): ?Godown
    {
        return Godown::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Godown
    {
        return Godown::create($data);
    }

    public function update(array $data, int $id): Godown
    {
        $record = Godown::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Godown::findOrFail($id);
        return $record->delete();
    }
}
