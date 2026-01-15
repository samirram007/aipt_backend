<?php

namespace App\Modules\Building\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'buildings';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'building_type',
        'total_area_sqft',
        'covered_area_sqft',
        'year_of_construction',
        'sesmic_zone_compliance',
        'structural_type',
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
            'status' => $this->status
        ];
    }
}
