<?php

namespace App\Modules\TransactionInstrument\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionInstrument extends Model
{
    use HasFactory, Blamable;

    protected $table = 'transaction_instruments';

    protected $fillable = [
        'voucher_id',
        'payment_mode_id',
        'payment_card_no',
        'cheque_no',
        'tid_no',
        'transaction_no',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
