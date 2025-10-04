<?php

namespace App\Modules\DiscountType\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\DiscountType\Models\DiscountType;

interface DiscountTypeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?DiscountType;
    public function store(array $data): DiscountType;
    public function update(array $data, int $id): DiscountType;
    public function delete(int $id): bool;
}
