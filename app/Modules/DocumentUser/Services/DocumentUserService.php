<?php

namespace App\Modules\DocumentUser\Services;

use App\Modules\DocumentUser\Contracts\DocumentUserServiceInterface;
use App\Modules\DocumentUser\Models\DocumentUser;
use Illuminate\Database\Eloquent\Collection;

class DocumentUserService implements DocumentUserServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return DocumentUser::with($this->resource)->get();
    }

    public function getById(int $id): ?DocumentUser
    {
        return DocumentUser::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DocumentUser
    {
        return DocumentUser::create($data);
    }

    public function update(array $data, int $id): DocumentUser
    {
        $record = DocumentUser::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DocumentUser::findOrFail($id);
        return $record->delete();
    }
}
