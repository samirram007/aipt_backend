<?php

namespace App\Modules\Document\Services;

use App\Modules\Document\Contracts\DocumentServiceInterface;
use App\Modules\Document\Models\Document;
use Illuminate\Database\Eloquent\Collection;

class DocumentService implements DocumentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Document::with($this->resource)->get();
    }

    public function getById(int $id): ?Document
    {
        return Document::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Document
    {
        return Document::create($data);
    }

    public function update(array $data, int $id): Document
    {
        $record = Document::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Document::findOrFail($id);
        return $record->delete();
    }
}
