<?php

namespace App\Modules\Language\Services;

use App\Modules\Language\Contracts\LanguageServiceInterface;
use App\Modules\Language\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageService implements LanguageServiceInterface
{
    public function getAll(): Collection
    {
        return Language::all();
    }

    public function getById(int $id): Language
    {
        return Language::findOrFail($id);
    }

    public function store(array $data): Language
    {
        return Language::create($data);
    }

    public function update(array $data, int $id): Language
    {
        $record = Language::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Language::findOrFail($id);
        return $record->delete();
    }
}
