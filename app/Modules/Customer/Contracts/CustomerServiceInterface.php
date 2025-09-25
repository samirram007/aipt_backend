<?php

namespace App\Modules\Customer\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Customer\Models\Customer;

interface CustomerServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Customer;
    public function store(array $data): Customer;
    public function update(array $data, int $id): Customer;
    public function delete(int $id): bool;
}
