<?php

namespace App\Modules\VoucherReference\Models;

use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoucherReference extends Model
{
    use HasFactory;

    protected $table = 'voucher_references';

    protected $fillable = [
        'voucher_id',
        'ref_voucher_id',
        'type',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
    public function reference_voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'ref_voucher_id', 'id');
    }
}
