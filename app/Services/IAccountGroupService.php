<?php

namespace App\Services;

use App\Http\Requests\AccountGroup\StoreAccountGroupRequest;
use App\Http\Requests\AccountGroup\UpdateAccountGroupRequest;
use App\Http\Resources\AccountGroup\AccountGroupCollection;
use App\Http\Resources\AccountGroup\AccountGroupResource;
use App\Models\AccountGroup;
use Illuminate\Database\Eloquent\Collection;

interface IAccountGroupService
{
    public function getAll():Collection;

    public function getById(int $id):?AccountGroup ;

    public function store(array $data):AccountGroup;

    public function update(array $data, int $id):AccountGroup;

    public function delete(int $id):bool;
}
