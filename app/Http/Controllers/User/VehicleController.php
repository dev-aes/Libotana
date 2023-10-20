<?php

namespace App\Http\Controllers\User;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function show(Vehicle $vehicle)
    {
        return view('user.vehicle.show', [
            'vehicle' => $vehicle->load('category', 'destinations'),
        ]);
    }
}