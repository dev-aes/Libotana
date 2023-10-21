<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationVehicle\DestinationVehicleRequest;
use App\Models\Destination;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DestinationVehicleController extends Controller
{
    public function create(Destination $destination)
    {
        return view('admin.destination_vehicle.create', [
            'vehicles' => Vehicle::all(),
            'current_vehicles' => Vehicle::whereRelation('destinations', 'destinations.id', $destination->id)->get(),
            'destination' => $destination,
        ]);
    }

    public function store(DestinationVehicleRequest $request, Destination $destination)
    {
        $destination->vehicles()->detach(); // remove all vehicles and populate new vehicles

        foreach($request->vehicle as $index => $vehicle)
        {
            if(filled($request->duration[$index]) &&  filled($request->vehicle[$index]) && filled($request->fare[$index]))
            {
                $destination->vehicles()->attach($vehicle, [
                    'duration' => $request->duration[$index],
                    'fare' => $request->fare[$index],
                ]);
            }

        }

        // foreach(array_combine($request->vehicle, $request->duration) as $vehicle => $duration)
        // {
        //     if(filled($duration) &&  filled($vehicle))
        //     {
        //         $destination->vehicles()->attach($vehicle, ['duration' => $duration]);
        //     }
        // }

        return to_route('admin.destinations.show', $destination)->with(['success' => 'Assigned Vehicle Updated Successfully']);
    }
}