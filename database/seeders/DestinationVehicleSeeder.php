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

            [
                'id' => 1,
                'destination_id' => 1,
                'vehicle_id' => 1,
                'duration' => '50 min',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'destination_id' => 1,
                'vehicle_id' => 2,
                'duration' => '50 min',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'destination_id' => 1,
                'vehicle_id' => 3,
                'duration' => '50 min',
                'created_at' => now(),
            ],


            [
                'id' => 4,
                'destination_id' => 2,
                'vehicle_id' => 1,
                'duration' => '50 min',
                'created_at' => now(),
            ],
        );

        DestinationVehicle::insert($destination_vehicles);
    }
}