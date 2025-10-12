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
        'parent_id',
        'code',
        'print_name',
        'description',
        'voucher_category_id',
        'is_financial',
        'is_effecting',
        'is_hidden',
        'is_system',
        'status',
        'icon',

    ];

    protected $casts = [
 'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function parent(): BelongsTo
    {
        return $this->BelongsTo(VoucherType::class);
    }
    public function voucher_category(): BelongsTo
    {
        return $this->BelongsTo(VoucherCategory::class);
    }
}
