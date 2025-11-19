<?php

namespace App\Modules\Godown\Contracts;


use App\Modules\Godown\Models\Godown;
use Illuminate\Support\Collection;

interface GodownServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Godown;
    public function store(array $data): Godown;
    public function update(array $data, int $id): Godown;
    public function delete(int $id): bool;
    public function getGodownItemStocks(int $item_id): Collection;
    public function getGodownItemBatches(int $item_id, int $godown_id): Collection;
}
