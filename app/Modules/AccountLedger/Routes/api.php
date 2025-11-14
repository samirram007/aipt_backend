<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AccountLedger\Controllers\Api\AccountLedgerController;

Route::apiResource('account_ledgers', AccountLedgerController::class)
    ->middleware('jwt.cookies');


Route::get('purchase_ledgers', [AccountLedgerController::class, 'purchase_ledgers'])
    ->middleware('jwt.cookies');
Route::get('sale_ledgers', [AccountLedgerController::class, 'sale_ledgers'])
    ->middleware('jwt.cookies');
Route::get('supplier_ledgers', [AccountLedgerController::class, 'supplier_ledgers'])
    ->middleware('jwt.cookies');
Route::get('distributor_ledgers', [AccountLedgerController::class, 'distributor_ledgers'])
    ->middleware('jwt.cookies');

