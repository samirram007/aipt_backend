<?php

namespace App\Modules\DeliveryRoute\Services;

use App\Modules\DeliveryRoute\Contracts\DeliveryRouteServiceInterface;
use App\Modules\DeliveryRoute\Models\DeliveryRoute;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRouteService implements DeliveryRouteServiceInterface
{
    protected $resource = ['source_place', 'destination_place'];

    public function getAll(): Collection
    {
        return DeliveryRoute::with($this->resource)->get();
    }

    public function getById(int $id): ?DeliveryRoute
    {
        return DeliveryRoute::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DeliveryRoute
    {
        return DeliveryRoute::create($data);
    }

    public function update(array $data, int $id): DeliveryRoute
    {
        $record = DeliveryRoute::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DeliveryRoute::findOrFail($id);
        return $record->delete();
    }
}
