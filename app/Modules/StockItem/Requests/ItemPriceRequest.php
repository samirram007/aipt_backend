<?php

namespace App\Modules\StockItem\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:stock_items,name'],
            'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:stock_items,code'],
            'print_name' => ['sometimes', 'required', 'string', 'max:255'],
            'sku' => ['sometimes', 'required', 'string', 'max:255'],
            'article_no' => ['sometimes', 'required', 'string', 'max:255'],
            'part_no' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'stock_category_id' => ['sometimes', 'required', 'integer', 'exists:stock_categories,id'],
            'stock_group_id' => ['sometimes', 'required', 'integer', 'exists:stock_groups,id'],
            'stock_unit_id' => ['sometimes', 'required', 'integer', 'exists:stock_units,id'],
            'alternative_stock_unit_id' => ['sometimes', 'required', 'integer', 'exists:stock_units,id'],
            'alternate_unit_ratio' => ['sometimes', 'required', 'numeric'],
            'invoice_stock_unit_id' => ['sometimes', 'required', 'integer', 'exists:stock_units,id'],
            'invoice_conversion_factor' => ['sometimes', 'required', 'numeric'],
            'no_of_decimal_places' => ['sometimes', 'required', 'integer'],
            'unique_quantity_codes_id' => ['sometimes', 'required', 'integer', 'exists:unique_quantity_codes,id'],
            'type_of_supply' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\TypeOfSupply::cases(), 'value'))],
            'is_negative_sales_allow' => ['sometimes', 'required', 'boolean'],
            'is_maintain_batch' => ['sometimes', 'required', 'boolean'],
            'is_maintain_serial' => ['sometimes', 'required', 'boolean'],
            'is_expiry_item' => ['sometimes', 'required', 'boolean'],
            'is_finish_goods' => ['sometimes', 'required', 'boolean'],
            'is_raw_material' => ['sometimes', 'required', 'boolean'],
            'is_unfinished_goods' => ['sometimes', 'required', 'boolean'],
            'costing_method' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\CostingMethod::cases(), 'value'))],
            'pricing_method' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\PricingMethod::cases(), 'value'))],
            'reorder_level' => ['sometimes', 'required', 'numeric'],
            'minimum_stock' => ['sometimes', 'required', 'numeric'],
            'maximum_stock' => ['sometimes', 'required', 'numeric'],
            'has_bom' => ['sometimes', 'required', 'boolean'],
            'is_sales_as_new_manufacture' => ['sometimes', 'required', 'boolean'],
            'is_purchase_as_consumed' => ['sometimes', 'required', 'boolean'],
            'is_rejection_as_scrap' => ['sometimes', 'required', 'boolean'],
            'is_gst_applicable' => ['sometimes', 'required', 'boolean'],
            'rate_of_duty' => ['sometimes', 'required', 'numeric'],
            'hsn_sac_code' => ['sometimes', 'required', 'string', 'max:255'],
            'is_gst_inclusive' => ['sometimes', 'required', 'boolean'],
            'gst_type' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\GstType::cases(), 'value'))],
            'brand_id' => ['sometimes', 'required', 'integer', 'exists:brands,id'],
            'mrp' => ['sometimes', 'required', 'numeric'],
            'standard_cost' => ['sometimes', 'required', 'numeric'],
            'icon' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('stock_item');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_items,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_items,code,' . $id,];

        }

        return $rules;
    }
    // 'name',
    //     'code',
    //     'print_name',
    //     'sku',
    //     'article_no',
    //     'part_no',
    //     'description',
    //     'stock_category_id',
    //     'stock_group_id',
    //     'stock_unit_id',
    //     'alternative_stock_unit_id',
    //     'alternate_unit_ratio',
    //     'invoice_stock_unit_id',
    //     'invoice_conversion_factor',
    //     'no_of_decimal_places',
    //     'uqc_id',
    //     'type_of_supply',
    //     'is_negative_sales_allow',
    //     'is_maintain_batch',
    //     'is_maintain_serial',
    //     'is_expiry_item',
    //     'is_finish_goods',
    //     'is_raw_material',
    //     'is_unfinished_goods',
    //     'costing_method',
    //     'pricing_method',
    //     'reorder_level',
    //     'minimum_stock',
    //     'maximum_stock',
    //     'has_bom',
    //     'is_sales_as_new_manufacture',
    //     'is_purchase_as_consumed',
    //     'is_rejection_as_scrap',
    //     'is_gst_applicable',
    //     'rate_of_duty',
    //     'hsn_sac_code',
    //     'is_gst_inclusive',
    //     'gst_type',
    //     'brand_id',
    //     'mrp',
    //     'standard_cost',
    //     'icon',
    //     'status',
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'code.unique' => 'The code has already been taken.',
            'description.required   ' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
