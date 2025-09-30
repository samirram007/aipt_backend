<?php

namespace App\Modules\VoucherReference\Models;

use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoucherReference extends Model
{
    use HasFactory;

    protected $table = 'voucher_references';

    protected $fillable = [
        'voucher_id',
        'ref_voucher_id'

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }
    public function reference_vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'ref_voucher_id');
    }
}
