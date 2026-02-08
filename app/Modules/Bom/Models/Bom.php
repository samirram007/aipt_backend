<?php

namespace App\Modules\Bom\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\BomDetail\Models\BomDetail;
use App\Modules\StockItem\Models\StockItem;

class Bom extends Model
{
    use HasFactory;

    protected $table = 'boms';

    protected $fillable = [
        'name',
        'stock_item_id',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(BomDetail::class, 'bom_id');
    }

    public function stockItem()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id');
    }

}