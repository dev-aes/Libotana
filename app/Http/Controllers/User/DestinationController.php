<?php

namespace App\Http\Controllers\User;

use App\Models\Search;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $search_destination = $request->destination_id;

        $destinations = Destination::with('vehicles.category')->get();

        $selected_destination = $search_destination ? Destination::with('vehicles.category')->whereId($search_destination)->first() : null;

        $selected_destination ? auth()->user()->searches()->firstOrCreate(['destination_id' => $selected_destination->id]) : '';   // saved search destination

        $searches = Search::with('destination')->whereBelongsTo(auth()->user())->get();

        return view('user.destination.index', compact(
            'destinations', 
            'selected_destination', 
            'searches'
        ));

    }

    public function show(Destination $destination)
    {
        return view('user.destination.show', [
            'destination' => $destination->load('vehicles'),
        ]);
    }
}