<?php

namespace App\Modules\Language\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Language\Models\Language;

interface LanguageServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Language;
    public function store(array $data): Language;
    public function update(array $data, int $id): Language;
    public function delete(int $id): bool;
}
