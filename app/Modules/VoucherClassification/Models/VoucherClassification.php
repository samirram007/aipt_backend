<?php

namespace App\Modules\VoucherClassification\Models;

use App\Modules\VoucherType\Models\VoucherType;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherClassification extends Model
{
    use HasFactory, Blamable;

    protected $table = 'voucher_classifications';

    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'voucher_type_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function voucher_type(): BelongsTo
    {
        return $this->BelongsTo(VoucherType::class);
    }
}
