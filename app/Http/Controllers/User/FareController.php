<?php

namespace App\Http\Controllers\User;

use App\Models\Fare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FareController extends Controller
{
    public function __invoke()
    {
        return view('user.fare.index', [
            'tricycle_fares' => Fare::tricycle()->get(),
            'jeepney_fares' => Fare::jeepney()->get(),
        ]);
    }
}