<?php

namespace App\Http\Controllers\User;

use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return view('user.vehicle.index', [
            'vehicles' => Vehicle::query()
            ->when($request->filled('category'), fn($query) => $query->where('category_id', $request->category))
            ->with([
                'category',
                'media', 
            ])
            ->latest()
            ->paginate(10)
            ->withQueryString(),
            'categories' => Category::pluck('name', 'id'),
        ]);
     
    }

    public function show(Vehicle $vehicle)
    {
        return view('user.vehicle.show', [
            'vehicle' => $vehicle->load('category', 'destinations'),
        ]);
    }
}