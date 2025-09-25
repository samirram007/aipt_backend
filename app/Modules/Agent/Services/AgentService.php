<?php

namespace App\Modules\Agent\Services;

use App\Modules\Agent\Contracts\AgentServiceInterface;
use App\Modules\Agent\Models\Agent;
use Illuminate\Database\Eloquent\Collection;

class AgentService implements AgentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Agent::with($this->resource)->get();
    }

    public function getById(int $id): ?Agent
    {
        return Agent::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Agent
    {
        return Agent::create($data);
    }

    public function update(array $data, int $id): Agent
    {
        $record = Agent::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Agent::findOrFail($id);
        return $record->delete();
    }
}
