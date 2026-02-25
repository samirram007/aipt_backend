<?php

namespace App\Modules\VoucherDispatchDetail\Models;

use App\Enums\QuantityType;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherDispatchDetail extends Model
{
    use HasFactory;

    protected $table = 'voucher_dispatch_details';

    protected $fillable = [
        'voucher_id',
        'order_number',
        'payment_terms',
        'other_references',
        'terms_of_delivery',
        'receipt_doc_no',
        'dispatched_through',
        'source',
        'destination',
        'destination_secondary',
        'billing_preference',
        'carrier_name',
        'bill_of_lading_no',
        'bill_of_lading_date',
        'motor_vehicle_no',
        'distance',
        'distance_unit_id',
        'rate',
        'rate_unit_id',
        'quantity',
        'quantity_unit_id',
        'weight',
        'weight_unit_id',
        'volume',
        'volume_unit_id',
        'freight_basis',
        'loading_charges',
        'unloading_charges',
        'packing_charges',
        'insurance_charges',
        'other_charges',
        'freight_charges',
        'total_fare',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'bill_of_lading_date' => 'date',
        'distance' => 'decimal:4',
        'rate' => 'decimal:2',
        'quantity' => 'decimal:4',
        'weight' => 'decimal:4',
        'volume' => 'decimal:4',
        'loading_charges' => 'decimal:2',
        'unloading_charges' => 'decimal:2',
        'packing_charges' => 'decimal:2',
        'insurance_charges' => 'decimal:2',
        'other_charges' => 'decimal:2',
        'freight_charges' => 'decimal:2',
        'total_fare' => 'decimal:2',
        'freight_basis' => QuantityType::class,

    ];
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }



    public function distanceUnit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'distance_unit_id');
    }

    public function rateUnit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'rate_unit_id');
    }
}
