<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TestItemReportTemplate\Controllers\Api\TestItemReportTemplateController;

Route::apiResource('test_item_report_templates', TestItemReportTemplateController::class)->middleware(['jwt.cookies']);

Route::get('test_item_report_templates/{id}/get_by_test_id',[TestItemReportTemplateController::class,'showTestById'])->middleware(['jwt.cookies']);
