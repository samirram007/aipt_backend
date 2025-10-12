<?php

namespace App\Modules\LeaveType\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\LeaveType\Models\LeaveType;

interface LeaveTypeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?LeaveType;
    public function store(array $data): LeaveType;
    public function update(array $data, int $id): LeaveType;
    public function delete(int $id): bool;
}
