<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Vehicle;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        $vehicles = Vehicle::query();
        
        return view('admin.dashboard.index', [
            'activities' => Activity::latest()->take(5)->get(),
            'total_vehicle' => $vehicles->count(),
            'total_destination' => Destination::count(),
            'total_active_user' => User::notAdmin()->active()->count(),
            'total_inactive_user' => User::notAdmin()->inactive()->count(),
            'vehicles' => $vehicles->paginate(10),
            'users' => User::whereRelation('role', 'name', '!=', 'admin')->latest()->paginate(10),
            'chart_monthly_users' => $this->getMonthlyUsers(),
            'chart_total_vehicles_by_category' => $this->getTotalVehiclesByCategory(),
            'destinations' => Destination::with('media')->paginate(5),
        ]);
    }

    private function getTotalVehiclesByCategory()
    {
        $categories = [];
        $vehicles = [];

        foreach (Category::with('vehicles')->get() as $category) {
            $categories[] = $category->name ; //
            $vehicles[] = $category->vehicles->count();
        }

        return [$categories, $vehicles];
    }

    

    public function getMonthlyUsers()
    {
        $monthly_users = User::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_users = array();

        foreach ($monthly_users as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_users as $total) {
            $total_monthly_users[] = $total->total_users;
        }

        return [$months, $total_monthly_users]; // sorted
    }
}