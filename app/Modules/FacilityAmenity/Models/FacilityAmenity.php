<?php

namespace App\Modules\FacilityAmenity\Models;

use App\Modules\Amenity\Models\Amenity;
use App\Modules\Facility\Models\Facility;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityAmenity extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'facility_amenities';

    public $timestamps = false;

    protected $fillable = [
        'facility_id',
        'amenity_id',

    ];

    protected $casts = [];

    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
