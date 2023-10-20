<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class NearestDestinationController extends Controller
{
    /**
     * get the location coordinates based on the authenticated user live location
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        $nearest_destinations = $this->get_nearest_destinations(current_location: $request);

        $sorted_nearest_destinations = $nearest_destinations->sortBy('distance'); // Sort the nearest destinations based on distance

        return $this->res($sorted_nearest_destinations);
    }

    private function get_nearest_destinations($current_location)
    {
        // $currentLocation = [
        //     'latitude' => 13.463530,
        //     'longitude' => 123.363930,
        // ];
        

        $destinations = Destination::all();  // Retrieve all destinations from the database

        // Calculate the distance to each destination and add it as a new attribute to each station
        $destinations->transform(function ($destination) use ($current_location) {

            return [
                'id' => $destination->id,
                'title' => $destination->title,
                'distance' => $this->calculate_distance($current_location['latitude'], $current_location['longitude'], $destination->latitude, $destination->longitude)
            ];

            // $destination->distance = $this->calculate_distance($current_location['latitude'], $current_location['longitude'], $destination->latitude, $destination->longitude);
            // return $destination;
        });

        $destinations = $destinations->sortBy('distance'); // Sort the destinations based on their distance in ascending order

        $nearest_destinations = $destinations->take(3);  // Retrieve the top three nearest destinations

        return $nearest_destinations;
    }

    // Helper function to calculate the distance between two sets of coordinates using the Haversine formula
    private function calculate_distance($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 6371; // Radius of the earth in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earth_radius * $c;

        return $distance;
    }
}