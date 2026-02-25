<?php

namespace App\Modules\Vendor\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Vendor\Models\Vendor;

interface VendorServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Vendor;
    public function store(array $data): Vendor;
    public function update(array $data, int $id): Vendor;
    public function delete(int $id): bool;
}
