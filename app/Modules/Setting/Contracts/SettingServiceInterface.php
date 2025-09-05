<?php

namespace App\Modules\Setting\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Setting\Models\Setting;

interface SettingServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Setting;
    public function store(array $data): Setting;
    public function update(array $data, int $id): Setting;
    public function delete(int $id): bool;
}
