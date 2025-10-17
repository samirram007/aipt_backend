<?php

namespace App\Modules\TestItem\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\StockCategory\Resources\StockCategoryResource;
use App\Modules\StockUnit\Resources\StockUnitResource;
use App\Modules\TestItemReportTemplate\Resources\TestItemReportTemplateResource;

class TestItemResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
                   'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'printName' => $this->print_name,
            'sku' => $this->sku,
            'articleNo' => $this->article_no,
            'partNo' => $this->part_no,
            'description' => $this->description,
            'stockCategoryId' => $this->stock_category_id,
            'stockGroupId' => $this->stock_group_id,
            'stockUnitId' => $this->stock_unit_id,
            'alternateStockUnitId' => $this->alternate_stock_unit_id,
            'baseUnitValue' => $this->base_unit_value,
            'alternateUnitValue' => $this->alternate_unit_value,
            'uniqueQuantityId' => $this->unique_quantity_id,
            'typeOfSupply' => $this->type_of_supply,
            'isNegativeSalesAllow' => $this->is_negative_sales_allow,
            'isMaintainBatch' => $this->is_maintain_batch,
            'isMaintainSerial' => $this->is_maintain_serial,
            'useExpiryDate' => $this->use_expiry_date,
            'trackManufacturingDate' => $this->track_manufacturing_date,

            'isFinishGoods' => $this->is_finish_goods,
            'isRawMaterial' => $this->is_raw_material,
            'isUnfinishedGoods' => $this->is_unfinished_goods,
            'costingMethod' => $this->costing_method,
            'marketValuationMethod' => $this->market_valuation_method,
            'reorderLevel' => $this->reorder_level,
            'minimumStock' => $this->minimum_stock,
            'maximumStock' => $this->maximum_stock,
            'hasBom' => $this->has_bom,
            'isSalesAsNewManufacture' => $this->is_sales_as_new_manufacture,
            'isPurchaseAsConsumed' => $this->is_purchase_as_consumed,
            'isRejectionAsScrap' => $this->is_rejection_as_scrap,
            'isGstApplicable' => $this->is_gst_applicable,
            'rateOfDuty' => $this->rate_of_duty,
            'hsnSacCode' => $this->hsn_sac_code,
            'isGstInclusive' => $this->is_gst_inclusive,
            'gstType' => $this->gst_type,
            'brandId' => $this->brand_id,
            'mrp' => $this->mrp,
            'standardCost' => $this->standard_cost,
            'standardSellingPrice' => $this->standard_selling_price,
            'icon' => $this->icon,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'isPackage' => $this->is_package,
            'isSampleRequired'=> $this->is_sample_required,
            'sampleName'=> $this->sample_name,
            'processDuration' => $this->process_duration,
            'processType'=> $this->process_type,


            'stockUnit' => StockUnitResource::make($this->whenLoaded('stock_unit')),
            'alternateStockUnit' => StockUnitResource::make($this->whenLoaded('alternate_stock_unit')),
            'stockCategory' => StockCategoryResource::make($this->whenLoaded('stock_category')),
            'testItemReportTemplates' => TestItemReportTemplateResource::collection($this->whenLoaded('test_item_report_templates'))

        ];
    }
}
