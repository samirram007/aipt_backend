<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestBooking\Controllers\Api\TestBookingController;

Route::apiResource('test_bookings', TestBookingController::class)->middleware(['jwt.cookies']);
Route::post('booking_confirmation', [TestBookingController::class, 'confirm_payment'])->middleware(['jwt.cookies']);
Route::get('bookings', [TestBookingController::class, 'all_bookings'])->middleware(['jwt.cookies']);
