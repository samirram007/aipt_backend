<?php

namespace App\Modules\TestBooking\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestBooking\Models\TestBooking;

interface TestBookingServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TestBooking;
    public function store(array $data): TestBooking;
    public function update(array $data, int $id): TestBooking;
    public function delete(int $id): bool;
    public function confirm_payment(array $data): TestBooking;
    public function all_bookings():Collection;
}
