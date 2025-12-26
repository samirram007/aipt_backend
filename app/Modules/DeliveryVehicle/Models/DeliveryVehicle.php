<?php

namespace App\Modules\DeliveryVehicle\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryVehicle extends Model
{
    use HasFactory;

    protected $table = 'delivery_vehicles';

    protected $fillable = [
        'transporter_id',
        'vehicle_type',
        'vehicle_number',
        'capacity',
        'driver_name',
        'driver_contact',
        'description',
        'status',

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


}
