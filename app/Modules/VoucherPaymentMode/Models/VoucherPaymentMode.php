<?php

namespace App\Modules\VoucherPaymentMode\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherPaymentMode extends Model
{
    use HasFactory;

    protected $table = 'voucher_payment_modes';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
