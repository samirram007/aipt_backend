<?php

namespace App\Modules\VoucherDispatchDetail\Models;

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
        'destination',
        'carrier_name',
        'bill_of_lading_no',
        'bill_of_lading_date',
        'motor_vehicle_no',
    ];

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
