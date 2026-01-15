<?php

namespace App\Modules\Room\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Room extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'rooms';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'room_number',
        'status',
    ];

    protected $appends = ['bed_count'];

    public function getAttributeBedCount()
    {
        return 50;
    }

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
            'roomNumber' => $this->room_number
        ];
    }
}
