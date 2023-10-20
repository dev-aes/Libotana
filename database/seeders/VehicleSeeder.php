<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $vehicles = [
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'jeepney A',
                'routes' => 'MainGate - Friendship',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'name' => 'jeepney B',
                'routes' => 'Checkpoint - Balibago - Hiway',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'name' => 'jeepney C',
                'routes' => 'Checkpoint - Hensonville - Holy',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'name' => 'jeepney D',
                'routes' => 'SM - Checkpoint - Holy - Highway',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'category_id' => 1,
                'name' => 'jeepney E',
                'routes' => 'Clark - Maingate - DAU',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'category_id' => 1,
                'name' => 'jeepney F',
                'routes' => 'Marisol - Pampangaa',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'category_id' => 1,
                'name' => 'jeepney G',
                'routes' => 'Sapang bato - Angeles',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'category_id' => 1,
                'name' => 'Pandan Jeep',
                'routes' => 'Pandan - Pampanga',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'category_id' => 1,
                'name' => 'jeepney I',
                'routes' => 'Sunset - Nepo',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'category_id' => 1,
                'name' => 'jeepney J',
                'routes' => 'Villa - Pampanga',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'category_id' => 1,
                'name' => 'jeepney K',
                'routes' => 'Capaya - Angeles',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'category_id' => 2,
                'name' => 'Torres Jesus Toda Tricycle',
                'routes' => 'Crossing - Apu Shrine - Nepo Mall - Diegs',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'category_id' => 2,
                'name' => 'Sta. trinidad Toda Tricycle',
                'routes' => 'Lourdes Northwest - Ospital Ning Angeles - Angeles City Public Market - Cuayan',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'category_id' => 2,
                'name' => 'Capaya 1 Toda Tricycle',
                'routes' => 'Metrogate - AUF - Pandan - Marisol Maingate',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 15,
                'category_id' => 2,
                'name' => 'Batis Asul Toda tricycle',
                'routes' => 'Sto. domingo - Lapieta - Pulungbulu - Holy Angel - Nepo Mart',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 16,
                'category_id' => 2,
                'name' => 'Lourdes Northwest toda tricycle',
                'routes' => 'Sta. teresita - City College Of Angeles - Holy Mary - Carmenville - Sunset Trade School',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 17,
                'category_id' => 2,
                'name' => 'Pulung bulo toda tricycle',
                'routes' => 'Burgos Plaridel - Manga - Pinerose - Philippine Rabbit Terminal',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 18,
                'category_id' => 2,
                'name' => 'HensonVille Plaza Toda tricycle',
                'routes' => 'Amsic - SM Clark - Jollibee Friendship - Anunas - Sapangbato',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 19,
                'category_id' => 2,
                'name' => 'Pulung maragul toda tricycle',
                'routes' => 'Marquee Mall - johnny’s SuperMarket - Robinson Mall - Northville Cutud',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 20,
                'category_id' => 2,
                'name' => 'ONA Toda tricycle',
                'routes' => 'Bagong bayan - Mcdo Henson - Holy Family Village - Holy Family Cutcut',
                'terminal' => 'N/A',
                'created_at' => now(),
            ],
        ];

        Vehicle::insert($vehicles);

        Vehicle::all()->each(fn(
            $vehicle) => $service->log_activity(model:$vehicle, event:'added', model_name: 'Vehicle', model_property_name: $vehicle->name)
        );
    }
}