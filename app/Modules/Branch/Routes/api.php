<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Branch\Controllers\Api\BranchController;

Route::apiResource('branches', BranchController::class)->middleware(['jwt.cookies']);
