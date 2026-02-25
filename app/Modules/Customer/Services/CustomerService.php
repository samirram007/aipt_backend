<?php

namespace App\Modules\Customer\Services;

use App\Modules\Customer\Contracts\CustomerServiceInterface;
use App\Modules\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService implements CustomerServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Customer::with($this->resource)->get();
    }

    public function getById(int $id): ?Customer
    {
        return Customer::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(array $data, int $id): Customer
    {
        $record = Customer::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Customer::findOrFail($id);
        return $record->delete();
    }
}
