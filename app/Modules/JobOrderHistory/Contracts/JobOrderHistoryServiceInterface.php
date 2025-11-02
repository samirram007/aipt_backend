<?php

namespace App\Modules\JobOrderHistory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;

interface JobOrderHistoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?JobOrderHistory;
    public function store(array $data): JobOrderHistory;
    public function update(array $data, int $id): JobOrderHistory;
    public function delete(int $id): bool;
}
