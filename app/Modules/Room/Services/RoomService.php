<?php

namespace App\Modules\Room\Services;

use App\Modules\Room\Contracts\RoomServiceInterface;
use App\Modules\Room\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class RoomService implements RoomServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Room::with($this->resource)->get();
    }

    public function getById(int $id): ?Room
    {
        return Room::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Room
    {
        return Room::create($data);
    }

    public function update(array $data, int $id): Room
    {
        $record = Room::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Room::findOrFail($id);
        return $record->delete();
    }
}
