<?php

namespace App\Modules\VoucherCategory\Models;

use App\Modules\VoucherType\Models\VoucherType;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoucherCategory extends Model
{
    use HasFactory, Blamable;

    protected $table = 'voucher_categories';
    protected $fillable = [
        'name',
        'code',
        'description',
        'module_link',
        'status',
        'icon',
        'created_by',
        'updated_by'
    ];
    protected $casts = [];

    public function voucher_types(): HasMany
    {
        return $this->hasMany(VoucherType::class);
    }
}
