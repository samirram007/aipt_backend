<?php

namespace App\Modules\DeliveryRoute\Models;

use App\Modules\DeliveryPlace\Models\DeliveryPlace;
use App\Modules\Godown\Models\Godown;
use App\Modules\StockUnit\Models\StockUnit;
use App\Modules\Transporter\Models\Transporter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRoute extends Model
{
    use HasFactory;

    protected $table = 'delivery_routes';

    protected $fillable = [
        'transporter_id',
        'source_place_id',
        'destination_place_id',
        'vehicle_no',
        'distance_km',
        'rate',
        'rate_unit_id',
        'estimated_time_in_minutes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'distance_km' => 'decimal:3',
        'rate' => 'decimal:2',
        'estimated_time_in_minutes' => 'decimal:2',
    ];

    public function transporter(): BelongsTo
    {
        return $this->belongsTo(Transporter::class, 'transporter_id');
    }
    public function source_place(): BelongsTo
    {
        return $this->belongsTo(Godown::class, 'source_place_id');
    }

    public function destination_place(): BelongsTo
    {
        return $this->belongsTo(DeliveryPlace::class, 'destination_place_id');
    }
    public function rate_unit(): BelongsTo
    {
        return $this->belongsTo(StockUnit::class, 'rate_unit_id');
    }
}
