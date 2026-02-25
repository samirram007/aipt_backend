<?php

namespace App\Modules\Currency\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Currency\Models\Currency;

interface CurrencyServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Currency;
    public function store(array $data): Currency;
    public function update(array $data, int $id): Currency;
    public function delete(int $id): bool;
}
