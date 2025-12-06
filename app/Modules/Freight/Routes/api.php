<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Freight\Controllers\Api\FreightController;

//Route::apiResource('freights', FreightController::class)->middleware(['jwt.cookies']);
Route::post('freights', [FreightController::class, 'store'])->middleware(['jwt.cookies']);
Route::get('freights/delivery_note', [FreightController::class, 'delivery_note'])->middleware(['jwt.cookies']);
Route::get('freights/freight', [FreightController::class, 'index'])->middleware(['jwt.cookies']);
