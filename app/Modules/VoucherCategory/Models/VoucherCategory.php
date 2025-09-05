<?php

namespace App\Modules\VoucherCategory\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class VoucherCategory extends Model
{
    use HasFactory;

    protected $table = 'voucher_categories';
    protected $fillable = [
        'name',
        'code',
        'description',
        'module_link',
        'status',
        'icon',

    ];
    protected $casts = [

    ];

}
