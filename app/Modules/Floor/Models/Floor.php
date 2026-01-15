<?php

namespace App\Modules\Floor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Floor extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'floors';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'floor_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFacilityDescriptionAttribute()
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'floorNumber' => $this->floor_number
        ];
    }
}
