<?php


use Illuminate\Support\Facades\Route;
use App\Modules\DayBook\Controllers\Api\DayBookController;

// Route::apiResource('day_books', DayBookController::class)->middleware(['jwt.cookies']);

// Route::apiResource('day_books', VoucherController::class)->middleware(['jwt.cookies']);
// Route::apiResource('day_books', VoucherController::class)->middleware(['jwt.cookies']);
Route::get('day_books', [DayBookController::class, 'index'])->middleware(['jwt.cookies']);
Route::get('day_books_self', [DayBookController::class, 'dayBooksSelf'])->middleware(['jwt.cookies']);

