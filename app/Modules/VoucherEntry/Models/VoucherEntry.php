<?php

namespace App\Modules\VoucherEntry\Models;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Voucher\Models\Voucher;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherEntry extends Model
{
    use HasFactory, Blamable;

    protected $table = 'voucher_entries';

    protected $fillable = [
        'voucher_id',
        'entry_order',
        'account_ledger_id',
        'debit',
        'credit',
        'remarks',
        'rate',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function account_ledger(): BelongsTo
    {
        return $this->belongsTo(AccountLedger::class, 'account_ledger_id', 'id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
