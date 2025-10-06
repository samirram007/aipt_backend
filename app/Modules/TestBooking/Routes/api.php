<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestBooking\Controllers\Api\TestBookingController;

Route::apiResource('test_bookings', TestBookingController::class)->middleware(['jwt.cookies']);
