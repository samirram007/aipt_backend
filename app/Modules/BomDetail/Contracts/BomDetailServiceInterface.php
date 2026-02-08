<?php

namespace App\Modules\BomDetail\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\BomDetail\Models\BomDetail;

interface BomDetailServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?BomDetail;
    public function store(array $data): BomDetail;
    public function update(array $data, int $id): BomDetail;
    public function delete(int $id): bool;
}
