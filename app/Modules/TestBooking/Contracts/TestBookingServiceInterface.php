<?php

namespace App\Modules\TestBooking\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestBooking\Models\TestBooking;
use Illuminate\Http\JsonResponse;

interface TestBookingServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TestBooking;
    public function store(array $data): TestBooking;
    public function update(array $data, int $id): TestBooking;
    public function delete(int $id): bool;
    public function confirm_payment(array $data): TestBooking;
    public function all_bookings(?string $start_date = null, ?string $end_date = null): Collection;
    public function post_payment_test_cancellation(): TestBooking;
    public function test_cancellation(array $data, int $id): bool;
    public function test_refund_request(array $data, int $id): bool;
    public function test_refund_confirm(array $data): TestBooking;

    // payment processing
    public function get_voucher_by_id(int $id): TestBooking;
}
