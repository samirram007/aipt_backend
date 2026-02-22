<?php

namespace App\Modules\ReceiptVoucher\Models;

use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiptVoucher extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope('receipt_voucher', function ($q) {
            $q->where('voucher_type_id', 1003);
        });
    }
}
