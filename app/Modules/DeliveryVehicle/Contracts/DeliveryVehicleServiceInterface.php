<?php

namespace App\Modules\DeliveryVehicle\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\DeliveryVehicle\Models\DeliveryVehicle;

interface DeliveryVehicleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?DeliveryVehicle;
    public function store(array $data): DeliveryVehicle;
    public function update(array $data, int $id): DeliveryVehicle;
    public function delete(int $id): bool;
}
