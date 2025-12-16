<?php

namespace App\Modules\DeliveryPlace\Services;

use App\Modules\DeliveryPlace\Contracts\DeliveryPlaceServiceInterface;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;
use Illuminate\Database\Eloquent\Collection;

class DeliveryPlaceService implements DeliveryPlaceServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return DeliveryPlace::with($this->resource)->get();
    }

    public function getById(int $id): ?DeliveryPlace
    {
        return DeliveryPlace::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DeliveryPlace
    {
        return DeliveryPlace::create($data);
    }

    public function update(array $data, int $id): DeliveryPlace
    {
        $record = DeliveryPlace::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DeliveryPlace::findOrFail($id);
        return $record->delete();
    }
}
