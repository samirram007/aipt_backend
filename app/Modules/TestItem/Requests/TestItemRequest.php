<?php

namespace App\Modules\TestItem\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestItemRequest extends FormRequest
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
            'sku' => ['sometimes', 'nullable', 'string', 'max:255'],
            'article_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'part_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'stock_category_id' => ['sometimes', 'required', 'integer', 'exists:stock_categories,id'],
            'stock_group_id' => ['sometimes', 'required', 'integer', 'exists:stock_groups,id'],
            'stock_unit_id' => ['sometimes', 'nullable', 'integer', 'exists:stock_units,id'],
            'alternate_stock_unit_id' => ['sometimes', 'required', 'integer', 'exists:stock_units,id'],
            'base_unit_value' => ['sometimes', 'nullable', 'numeric'],
            'alternate_unit_value' => ['sometimes', 'nullable', 'numeric'],
            'unique_quantity_code_id' => ['sometimes', 'nullable', 'integer', 'exists:unique_quantity_codes,id'],
            'type_of_supply' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\TypeOfSupply::cases(), 'value'))],
            'is_negative_sales_allow' => ['sometimes', 'required', 'boolean'],
            'is_maintain_batch' => ['sometimes', 'required', 'boolean'],
            'is_maintain_serial' => ['sometimes', 'required', 'boolean'],
            'use_expiry_date' => ['sometimes', 'required', 'boolean'],
            'track_manufacturing_date' => ['sometimes', 'required', 'boolean'],

            'is_finish_goods' => ['sometimes', 'required', 'boolean'],
            'is_raw_material' => ['sometimes', 'required', 'boolean'],
            'is_unfinished_goods' => ['sometimes', 'required', 'boolean'],
            'costing_method' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\CostingMethod::cases(), 'value'))],
            'market_valuation_method' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\MarketValuationMethod::cases(), 'value'))],
            'reorder_level' => ['sometimes', 'required', 'numeric'],
            'minimum_stock' => ['sometimes', 'required', 'numeric'],
            'maximum_stock' => ['sometimes', 'required', 'numeric'],
            'has_bom' => ['sometimes', 'required', 'boolean'],
            'is_sales_as_new_manufacture' => ['sometimes', 'required', 'boolean'],
            'is_purchase_as_consumed' => ['sometimes', 'required', 'boolean'],
            'is_rejection_as_scrap' => ['sometimes', 'required', 'boolean'],
            'is_gst_applicable' => ['sometimes', 'required', 'boolean'],
            'rate_of_duty' => ['sometimes', 'required', 'numeric'],
            'hsn_sac_code' => ['sometimes', 'nullable', 'string', 'max:255'],
            'is_gst_inclusive' => ['sometimes', 'required', 'boolean'],
            'gst_type' => ['sometimes', 'required', 'in:' . implode(',', array_column(\App\Enums\GstType::cases(), 'value'))],
            'brand_id' => ['sometimes', 'nullable', 'integer', 'exists:brands,id'],
            'mrp' => ['sometimes', 'required', 'numeric'],
            'standard_cost' => ['sometimes', 'required', 'numeric'],
            'standard_selling_price' => ['sometimes', 'required', 'numeric'],
            'icon' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'is_package' => ['sometimes', 'required', 'boolean'],
            'is_sample_required' => ['sometimes', 'required', 'boolean'],
            'sample_name' => ['sometimes', 'required', 'string','max:255'],
            'process_duration' => ['sometimes', 'required','numeric'],
            'process_type' => ['sometimes', 'required','string'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('stock_item');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_items,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_items,code,' . $id,];

        }
        //dd($rules);
        return $rules;
    }

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
