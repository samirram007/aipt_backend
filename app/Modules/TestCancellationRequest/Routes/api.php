<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestCancellationRequest\Controllers\Api\TestCancellationRequestController;

Route::get('test_cancellation_requests/get-by-booking/{bookingNo}', [TestCancellationRequestController::class, 'getByBookingNo'])->middleware(['jwt.cookies']);
Route::apiResource('test_cancellation_requests', TestCancellationRequestController::class)->middleware(['jwt.cookies']);
