<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Godown\Controllers\Api\GodownController;

Route::apiResource('godowns', GodownController::class)->middleware(['jwt.cookies']);
Route::get('godown_item_stocks/{item_id}', [GodownController::class, 'godown_item_stocks'])->middleware(['jwt.cookies']);
Route::get('godown_item_batches/{item_id}/{godown_id}', [GodownController::class, 'godown_item_batches'])->middleware(['jwt.cookies']);
