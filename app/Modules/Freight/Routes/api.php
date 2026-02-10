<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Freight\Controllers\Api\FreightController;

// Route::apiResource('freights', FreightController::class)->middleware(['jwt.cookies']);
Route::post('freights', [FreightController::class, 'store'])->middleware(['jwt.cookies']);
Route::get('freights/delivery_note', [FreightController::class, 'delivery_note'])->middleware(['jwt.cookies']);
Route::get('freights/freight/delivery_note', [FreightController::class, 'delivery_note'])->middleware(['jwt.cookies']);
Route::get('freights/freight', [FreightController::class, 'index'])->middleware(['jwt.cookies']);
Route::get('freights/freight/{id}', [FreightController::class, 'show'])->middleware(['jwt.cookies']);

Route::get('/freights_godown_wise', [FreightController::class, 'godown_wise'])->middleware(['jwt.cookies']);
Route::get('/freights_transporter_wise', [FreightController::class, 'transporter_wise'])->middleware(['jwt.cookies']);
Route::get('/freights_vehicle_wise', [FreightController::class, 'vehicle_wise'])->middleware(['jwt.cookies']);
Route::get('/freights_billing_preference', [FreightController::class, 'billing_preference'])->middleware(['jwt.cookies']);
Route::get('/freights_voucher_wise', [FreightController::class, 'voucher_wise'])->middleware(['jwt.cookies']);
