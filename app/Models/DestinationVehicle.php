<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DestinationVehicle extends Pivot
{
    use HasFactory;

    protected $table = "destination_vehicle";

    protected $fillable = [
        'destination_id',
        'vehicle_id',
        'duration'
    ];

}