<?php

namespace App\Modules\PaymentMode\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PaymentMode\Models\PaymentMode;

interface PaymentModeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PaymentMode;
    public function store(array $data): PaymentMode;
    public function update(array $data, int $id): PaymentMode;
    public function delete(int $id): bool;
}
