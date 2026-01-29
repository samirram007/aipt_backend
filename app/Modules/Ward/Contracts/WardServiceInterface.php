<?php

namespace App\Modules\Ward\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Ward\Models\Ward;

interface WardServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Ward;
    public function store(array $data): Ward;
    public function update(array $data, int $id): Ward;
    public function delete(int $id): bool;
}
