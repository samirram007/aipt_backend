<?php

namespace App\Modules\DeliveryRoute\Models;

use App\Modules\DeliveryPlace\Models\DeliveryPlace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRoute extends Model
{
    use HasFactory;

    protected $table = 'delivery_routes';

    protected $fillable = [
        'source_place_id',
        'destination_place_id',
        'distance_km',
        'rate',
        'estimated_time_in_minutes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'distance_km' => 'decimal:3',
        'rate' => 'decimal:2',
        'estimated_time_in_minutes' => 'decimal:2',
    ];

    public function source_place(): BelongsTo
    {
        return $this->belongsTo(DeliveryPlace::class, 'source_place_id');
    }

    public function destination_place(): BelongsTo
    {
        return $this->belongsTo(DeliveryPlace::class, 'destination_place_id');
    }
}
