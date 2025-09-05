<?php

namespace App\Modules\VoucherType\Models;

use App\Modules\VoucherCategory\Models\VoucherCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherType extends Model
{
    use HasFactory;

    protected $table = 'voucher_types';

    protected $fillable = [
        'name',
        'code',
        'description',
        'voucher_category_id',
        'is_financial',
        'status',
        'icon',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function voucher_category(): BelongsTo
    {
        return $this->BelongsTo(VoucherCategory::class);
    }
}
