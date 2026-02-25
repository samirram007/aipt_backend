<?php

use Illuminate\Support\Facades\Route;
use App\Modules\VoucherCategory\Controllers\Api\VoucherCategoryController;

Route::apiResource('voucher_categories', VoucherCategoryController::class)->middleware(['jwt.cookies']);
