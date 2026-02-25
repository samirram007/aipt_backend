<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Freight\Controllers\Api\FreightController;

//Route::apiResource('freights', FreightController::class)->middleware(['jwt.cookies']);
Route::post('freights', [FreightController::class, 'store'])->middleware(['jwt.cookies']);
Route::get('freights/delivery_note', [FreightController::class, 'delivery_note'])->middleware(['jwt.cookies']);
Route::get('freights/freight', [FreightController::class, 'index'])->middleware(['jwt.cookies']);

Route::get('/freights/godown_wise', [FreightController::class, 'godown_wise'])->middleware(['jwt.cookies']);
Route::get('/freights/transporter_wise', [FreightController::class, 'transporter_wise'])->middleware(['jwt.cookies']);
Route::get('/freights/vehicle_wise', [FreightController::class, 'vehicle_wise'])->middleware(['jwt.cookies']);
Route::get('/freights/billing_preference', [FreightController::class, 'billing_preference'])->middleware(['jwt.cookies']);
Route::get('/freights/voucher_wise', [FreightController::class, 'voucher_wise'])->middleware(['jwt.cookies']);

