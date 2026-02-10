<?php

namespace App\Modules\Receipt\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Receipt\Models\Receipt;

interface ReceiptServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Receipt;
    public function store(array $data): Receipt;
    public function update(array $data, int $id): Receipt;
    public function delete(int $id): bool;
}
