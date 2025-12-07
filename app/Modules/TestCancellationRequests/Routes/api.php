<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestCancellationRequests\Controllers\Api\TestCancellationRequestsController;

Route::apiResource('test_cancellation_requests', TestCancellationRequestsController::class)->middleware(['jwt.cookies']);
