<?php

namespace App\Modules\GstRegistrationType\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\GstRegistrationType\Models\GstRegistrationType;

interface GstRegistrationTypeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?GstRegistrationType;
    public function store(array $data): GstRegistrationType;
    public function update(array $data, int $id): GstRegistrationType;
    public function delete(int $id): bool;
}
