<?php

namespace App\Modules\BomDetail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Bom\Models\Bom;
use App\Modules\StockItem\Models\StockItem;

class BomDetail extends Model
{
    use HasFactory;

    protected $table = 'bom_details';

    protected $fillable = [
        'bom_id',
        'stock_item_id',
        'qty',
        'rate',
        'amount',
    ];

    public function bom()
    {
        return $this->belongsTo(Bom::class, 'bom_id');
    }
    public function stockItem()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id');
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}