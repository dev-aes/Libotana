<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([

            FareSeeder::class,
            CategorySeeder::class,
            VehicleSeeder::class,
            DestinationSeeder::class,
            DestinationVehicleSeeder::class,
            ArrivalSeeder::class,

            RoleSeeder::class,
            UserSeeder::class,
        ]);

    }
}