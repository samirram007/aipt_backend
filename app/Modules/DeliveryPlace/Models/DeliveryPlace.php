<?php

namespace App\Modules\DeliveryPlace\Models;

use App\Modules\Address\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class DeliveryPlace extends Model
{
    use HasFactory;

    protected $table = 'delivery_places';

    protected $fillable = [
        'name',
        'code',
        'place_type',
        'is_active',
        'remarks',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'status'
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function getStatusAttribute(): string
    {
        return $this->is_active ? 'active' : 'inactive';
    }
}
