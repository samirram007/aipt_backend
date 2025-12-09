<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestCancellationRequest\Controllers\Api\TestCancellationRequestController;

Route::apiResource('test_cancellation_requests', TestCancellationRequestController::class)->middleware(['jwt.cookies']);
