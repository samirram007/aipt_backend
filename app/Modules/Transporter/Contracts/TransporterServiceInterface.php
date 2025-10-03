<?php

namespace App\Modules\Transporter\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Transporter\Models\Transporter;

interface TransporterServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Transporter;
    public function store(array $data): Transporter;
    public function update(array $data, int $id): Transporter;
    public function delete(int $id): bool;
}
