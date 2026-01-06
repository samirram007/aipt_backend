<?php

namespace App\Modules\DeliveryVehicle\Services;

use App\Modules\DeliveryVehicle\Contracts\DeliveryVehicleServiceInterface;
use App\Modules\DeliveryVehicle\Models\DeliveryVehicle;
use Illuminate\Database\Eloquent\Collection;

class DeliveryVehicleService implements DeliveryVehicleServiceInterface
{
    protected $resource = ['transporter'];

    public function getAll(): Collection
    {
        // dd('calledtttt');
        return DeliveryVehicle::with($this->resource)->get();
    }

    public function getById(int $id): ?DeliveryVehicle
    {
        return DeliveryVehicle::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DeliveryVehicle
    {
        return DeliveryVehicle::create($data);
    }

    public function update(array $data, int $id): DeliveryVehicle
    {
        $record = DeliveryVehicle::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DeliveryVehicle::findOrFail($id);
        return $record->delete();
    }
}
