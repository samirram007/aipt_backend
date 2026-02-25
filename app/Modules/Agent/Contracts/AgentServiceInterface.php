<?php

namespace App\Modules\Agent\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Agent\Models\Agent;

interface AgentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Agent;
    public function store(array $data): Agent;
    public function update(array $data, int $id): Agent;
    public function delete(int $id): bool;
}
