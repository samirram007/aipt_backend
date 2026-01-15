<?php

namespace App\Modules\Facility\Models;

use App\Modules\Amenity\Models\Amenity;
use App\Modules\Building\Models\Building;
use App\Modules\FacilityAmenity\Models\FacilityAmenity;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'facilities';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'parent_id',
        'status',
        'facilityable_type',
        'facilityable_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    public function facilityable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Facility::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Facility::class, 'parent_id');
    }

    public function facility_amenities(): HasMany
    {
        return $this->hasMany(FacilityAmenity::class, 'facility_id', 'id');
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'facility_amenities', 'facility_id', 'amenity_id');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'facilityable_id');
    }
}
