<?php

namespace App\Modules\State\Services;

use App\Modules\State\Contracts\StateServiceInterface;
use App\Modules\State\Models\State;
use Illuminate\Database\Eloquent\Collection;

class StateService implements StateServiceInterface
{
    protected $resource = ['country'];

    public function getAll(): Collection
    {
        return State::with($this->resource)->get();
    }

    public function getById(int $id): ?State
    {
        return State::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): State
    {
        return State::create($data);
    }

    public function update(array $data, int $id): State
    {
        $record = State::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = State::findOrFail($id);
        return $record->delete();
    }
}
