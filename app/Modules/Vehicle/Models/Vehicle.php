<?php

namespace App\Modules\Vehicle\Models;

use App\Modules\Transporter\Models\Transporter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'transporter_id',
        'vehicle_type',
        'vehicle_no',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function transporter()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id');
    }
}
