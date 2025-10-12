<?php

namespace App\Modules\Holiday\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Holiday\Models\Holiday;

interface HolidayServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Holiday;
    public function store(array $data): Holiday;
    public function update(array $data, int $id): Holiday;
    public function delete(int $id): bool;
}
