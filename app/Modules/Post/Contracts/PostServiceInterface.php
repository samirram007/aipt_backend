<?php

namespace App\Modules\Post\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Post\Models\Post;

interface PostServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Post;
    public function store(array $data): Post;
    public function update(array $data, int $id): Post;
    public function delete(int $id): bool;
}
