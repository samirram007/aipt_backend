<?php

namespace App\Modules\Setting\Services;

use App\Modules\Setting\Contracts\SettingServiceInterface;
use App\Modules\Setting\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingService implements SettingServiceInterface
{
    public function getAll(): Collection
    {
        return Setting::all();
    }

    public function getById(int $id): Setting
    {
        return Setting::findOrFail($id);
    }

    public function store(array $data): Setting
    {
        return Setting::create($data);
    }

    public function update(array $data, int $id): Setting
    {
        $record = Setting::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Setting::findOrFail($id);
        return $record->delete();
    }
}
