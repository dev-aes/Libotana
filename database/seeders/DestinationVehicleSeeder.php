<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DestinationVehicle;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DestinationVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $destination_vehicles = array(

            // Marquee Mall - Pandan Jeep
            [
                'id' => 1,
                'destination_id' => 1,
                'vehicle_id' => 1,
                'duration' => '30 min',
                'created_at' => now(),
            ],
        );

        DestinationVehicle::insert($destination_vehicles);
    }
}