<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Campus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        return view('admin.dashboard.index', [
            'users' => User::whereRelation('role', 'name', '!=', 'admin')->latest()->paginate(10),
            'monthly_users' => $this->getMonthlyUsers()
        ]);
    }

    public function getMonthlyUsers()
    {
        $monthly_users = User::selectRaw("count(id) AS total_users,DATE_FORMAT(created_at, '%M-%Y') AS new_date,YEAR(created_at) AS year,monthname(created_at) AS month")
                        ->groupBy('new_date')
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
