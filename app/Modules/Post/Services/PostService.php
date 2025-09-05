<?php

namespace App\Modules\Post\Services;

use App\Modules\Post\Contracts\PostServiceInterface;
use App\Modules\Post\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostService implements PostServiceInterface
{
    public function getAll(): Collection
    {
        return Post::all();
    }

    public function getById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function store(array $data): Post
    {
        return Post::create($data);
    }

    public function update(array $data, int $id): Post
    {
        $record = Post::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Post::findOrFail($id);
        return $record->delete();
    }
}
