<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestBooking\Controllers\Api\TestBookingController;

Route::apiResource('test_bookings', TestBookingController::class)->middleware(['jwt.cookies']);
Route::get('test_booking/get-all-cancelled-tests', [TestBookingController::class, 'getAllCancelledBooking'])->middleware(['jwt.cookies']);
Route::post('booking_confirmation', [TestBookingController::class, 'confirm_payment'])->middleware(['jwt.cookies']);
Route::get('bookings/{start_date?}/{end_date?}', [TestBookingController::class, 'all_bookings'])->middleware(['jwt.cookies']);
Route::get('test_booking_search/{start_date}/{end_date}', [TestBookingController::class, 'test_booking_search'])->middleware(['jwt.cookies']);
Route::post('test_booking/{id}/test-cancel-request', [TestBookingController::class, 'test_cancellation'])->middleware(['jwt.cookies']);
Route::post('test_booking/{id}/test-refund-request', [TestBookingController::class, 'test_refund_request'])->middleware(['jwt.cookies']);
