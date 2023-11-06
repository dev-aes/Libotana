<?php

namespace Database\Seeders;

use App\Models\Fare;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $fares = array(
            ['id' => 1, 'type' => 'tricycle', 'kilometer' => 1, 'fare' => 30, 'discounted_fare' => 25, 'created_at' => now()],
            ['id' => 2, 'type' => 'tricycle', 'kilometer' => 4, 'fare' => 60, 'discounted_fare' => 55, 'created_at' => now()],
            ['id' => 3, 'type' => 'tricycle', 'kilometer' => 5, 'fare' => 70, 'discounted_fare' => 65, 'created_at' => now()],
            ['id' => 4, 'type' => 'tricycle', 'kilometer' => 7, 'fare' => 80, 'discounted_fare' => 75, 'created_at' => now()],
            ['id' => 5, 'type' => 'tricycle', 'kilometer' => 8, 'fare' => 90, 'discounted_fare' => 85, 'created_at' => now()],
            ['id' => 6, 'type' => 'tricycle', 'kilometer' => 9, 'fare' => 100, 'discounted_fare' => 95, 'created_at' => now()],
            ['id' => 7, 'type' => 'tricycle', 'kilometer' => 10, 'fare' => 110, 'discounted_fare' => 105, 'created_at' => now()],
            ['id' => 8, 'type' => 'tricycle', 'kilometer' => 11, 'fare' => 120, 'discounted_fare' => 115, 'created_at' => now()],
            ['id' => 9, 'type' => 'tricycle', 'kilometer' => 12, 'fare' => 130, 'discounted_fare' => 125, 'created_at' => now()],
            ['id' => 10, 'type' => 'tricycle', 'kilometer' => 13, 'fare' => 140, 'discounted_fare' => 135, 'created_at' => now()],
            ['id' => 11, 'type' => 'tricycle', 'kilometer' => 14, 'fare' => 150, 'discounted_fare' => 145, 'created_at' => now()],
            ['id' => 12, 'type' => 'tricycle', 'kilometer' => 15, 'fare' => 160, 'discounted_fare' => 155, 'created_at' => now()],
            ['id' => 13, 'type' => 'tricycle', 'kilometer' => 16, 'fare' => 170, 'discounted_fare' => 165, 'created_at' => now()],
            ['id' => 14, 'type' => 'tricycle', 'kilometer' => 17, 'fare' => 180, 'discounted_fare' => 175, 'created_at' => now()],
            ['id' => 15, 'type' => 'tricycle', 'kilometer' => 18, 'fare' => 190, 'discounted_fare' => 185, 'created_at' => now()],
            ['id' => 16, 'type' => 'tricycle', 'kilometer' => 19, 'fare' => 200, 'discounted_fare' => 195, 'created_at' => now()],
            ['id' => 17, 'type' => 'tricycle', 'kilometer' => 20, 'fare' => 210, 'discounted_fare' => 205, 'created_at' => now()],
            ['id' => 18, 'type' => 'jeepney', 'kilometer' => 1, 'fare' => 12.00, 'discounted_fare' => 9.50, 'created_at' => now()],
            ['id' => 19, 'type' => 'jeepney', 'kilometer' => 2, 'fare' => 12.00, 'discounted_fare' => 9.50, 'created_at' => now()],
            ['id' => 20, 'type' => 'jeepney', 'kilometer' => 3, 'fare' => 12.00, 'discounted_fare' => 9.50, 'created_at' => now()],
            ['id' => 21, 'type' => 'jeepney', 'kilometer' => 4, 'fare' => 12.00, 'discounted_fare' => 9.50, 'created_at' => now()],
            ['id' => 22, 'type' => 'jeepney', 'kilometer' => 5, 'fare' => 13.75, 'discounted_fare' => 11.75, 'created_at' => now()],
            ['id' => 23, 'type' => 'jeepney', 'kilometer' => 6, 'fare' => 15.50, 'discounted_fare' => 12.50, 'created_at' => now()],
            ['id' => 24, 'type' => 'jeepney', 'kilometer' => 7, 'fare' => 17.60, 'discounted_fare' => 14.60, 'created_at' => now()],
            ['id' => 25, 'type' => 'jeepney', 'kilometer' => 8, 'fare' => 19.25, 'discounted_fare' => 15.25, 'created_at' => now()],
            ['id' => 26, 'type' => 'jeepney', 'kilometer' => 9, 'fare' => 21.00, 'discounted_fare' => 16.00, 'created_at' => now()],
            ['id' => 27, 'type' => 'jeepney', 'kilometer' => 10, 'fare' => 24.50, 'discounted_fare' => 18.50, 'created_at' => now()],
            ['id' => 28, 'type' => 'jeepney', 'kilometer' => 11, 'fare' => 26.50, 'discounted_fare' => 19.50, 'created_at' => now()],
            ['id' => 29, 'type' => 'jeepney', 'kilometer' => 12, 'fare' => 28.25, 'discounted_fare' => 21.25, 'created_at' => now()],
            ['id' => 30, 'type' => 'jeepney', 'kilometer' => 13, 'fare' => 30.00, 'discounted_fare' => 22.00, 'created_at' => now()],
            ['id' => 31, 'type' => 'jeepney', 'kilometer' => 14, 'fare' => 31.75, 'discounted_fare' => 24.75, 'created_at' => now()],
            ['id' => 32, 'type' => 'jeepney', 'kilometer' => 15, 'fare' => 33.50, 'discounted_fare' => 25.50, 'created_at' => now()],
            ['id' => 33, 'type' => 'jeepney', 'kilometer' => 16, 'fare' => 35.50, 'discounted_fare' => 27.50, 'created_at' => now()],
            ['id' => 34, 'type' => 'jeepney', 'kilometer' => 17, 'fare' => 37.25, 'discounted_fare' => 28.25, 'created_at' => now()],
            ['id' => 35, 'type' => 'jeepney', 'kilometer' => 18, 'fare' => 39.00, 'discounted_fare' => 29.00, 'created_at' => now()],
            ['id' => 36, 'type' => 'jeepney', 'kilometer' => 19, 'fare' => 40.75, 'discounted_fare' => 31.75, 'created_at' => now()],
            ['id' => 37, 'type' => 'jeepney', 'kilometer' => 20, 'fare' => 42.50, 'discounted_fare' => 32.50, 'created_at' => now()],
            ['id' => 38, 'type' => 'jeepney', 'kilometer' => 21, 'fare' => 44.50, 'discounted_fare' => 34.50, 'created_at' => now()],
        );

        Fare::insert($fares);

        Fare::all()->each(fn(
            $fare) => $service->log_activity(model:$fare, event:'added', model_name: 'Fare', model_property_name: $fare->name)
        );
    }
}