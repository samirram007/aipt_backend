<?php

namespace App\Modules\Amenity\Models;

use App\Modules\AmenityCategory\Models\AmenityCategory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Amenity extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'amenities';

    protected $fillable = [
        'id',
        'code',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function amenity_categories(): BelongsTo
    {
        return $this->belongsTo(AmenityCategory::class, 'amenity_category_id');
    }
}
