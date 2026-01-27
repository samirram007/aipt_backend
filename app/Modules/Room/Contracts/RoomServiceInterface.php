<?php

namespace App\Modules\Room\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Room\Models\Room;

interface RoomServiceInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Room;
    public function store(array $data): Room;
    public function update(array $data, string $id): Room;
    public function delete(int $id): bool;
}
