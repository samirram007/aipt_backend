<?php

namespace App\Modules\DeliveryPlace\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\DeliveryPlace\Models\DeliveryPlace;

interface DeliveryPlaceServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?DeliveryPlace;
    public function store(array $data): DeliveryPlace;
    public function update(array $data, int $id): DeliveryPlace;
    public function delete(int $id): bool;
}
