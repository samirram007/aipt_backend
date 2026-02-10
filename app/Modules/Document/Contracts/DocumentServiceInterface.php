<?php

namespace App\Modules\Document\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Document\Models\Document;

interface DocumentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Document;
    public function store(array $data): Document;
    public function update(array $data, int $id): Document;
    public function delete(int $id): bool;
}
