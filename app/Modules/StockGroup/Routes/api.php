<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StockGroup\Controllers\Api\StockGroupController;


// Route::get('stock_groups', function ($request) {
//     dd($request->all());
// });
Route::apiResource('stock_groups', StockGroupController::class)->middleware(['jwt.cookies']);
