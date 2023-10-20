<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $destinations = array(
            [
                'id' => 1,
                'title' => 'SM Clark',
                'history' => 'Like a city that keeps on growing, SM City Clark in Pampanga never fails to fascinate us with its new and amazing attractions. Starting out as a 101,840 square-meter mall when it opened in 2006, it now sprawls at 308,909 square meters. It has likewise evolved into a complex, which now includes BPO Towers, a Tech Hub, a Park Inn by Radisson Hotel, National University, and SMX Convention Center.',
                'address' => 'Barangay, Manuel A. Roxas Hwy, Clark Freeport, Angeles, Pampanga',
                'latitude' => 15.17004750007,
                'longitude' => 120.5792299659,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'SM Telabastagan',
                'history' => 'SM Telabastagan with two floors of shopping, multicultural dining, and entertainment zones adorned by indoor pocket gardens that add a touch of nature improving the overall ambiance of the mall. It is a city that has so much to celebrate: exciting festivals, a rich history and culture, its food, and its people\'s entrepreneurial spirit.',
                'address' => 'MacArthur Hwy, BRGY, San Fernando, 2000 Pampanga',
                'latitude' => 15.12071206832,
                'longitude' => 120.6017481488,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Marquee Mall',
                'history' => 'MarQuee Mall is a shopping mall owned and operated by the North Beacon Commercial Corporation, a 100% wholly owned subsidiary of Ayala Land. It is located in Barangay Pulung Maragul, Angeles City, Philippines. The mall has a land area of 9.3 hectares (23 acres) and a gross floor area of 140,000 square meters (1,500,000 sq ft).',
                'address' => 'Francisco G MarQuee Mall Don Juan Nepomuceno Avenue, Angeles, Pampanga',
                'latitude' => 15.16281643669,
                'longitude' => 120.6098905948,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'title' => 'Pamintuan Mansion',
                'history' => 'The Pamintuan Mansion is a historic building in Angeles City, Philippines built by the Pamintuan family in the 1880s. It was briefly used by the Katipunan during the Philippine-American War. It currently hosts a social science museum.',
                'address' => '4HPR+8H8, Angeles, Pampanga',
                'latitude' => 15.13594403510,
                'longitude' => 120.5913405064,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'title' => 'Azure North',
                'history' => 'Azure North is a condo project developed by Century Properties, Azure North has 20 floors. Units range from studio to 2 bedrooms. Azure North at San Fernando, Pampanga has facilities including air conditioning, CCTV, fitness, garden, parking, playground, security, swimming pool, and Wi-Fi.',
                'address' => 'Jose Abad Santos Ave. San Fernando, 0000, San Fernando, 2000 Pampanga',
                'latitude' => 15.04608271780,
                'longitude' => 120.6954578064,
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'title' => 'S&R Mabalacat',
                'history' => 'S&R Membership Shopping - Dau Mabalacat is one of the 2nd branches in Pampanga warehouse clubs in the Philippines that offers premium quality imported products and services. With 1 out of 22 branches and 51 Quick Service Restaurants, members can enjoy world-class shopping nationwide. S&R offers a wide selection of imported products, including food, wine, liquor, furniture, appliances, health products, and household items.',
                'address' => '4207 Dau, Mabalacat, 2010 Pampanga',
                'latitude' => 15.18061028696,
                'longitude' => 120.5975460266,
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'title' => 'Sky Ranch',
                'history' => 'SKY Ranch Pampanga is the first amusement park and the newest destination for both residents and tourists in the North of Luzon. Opened on November 30, 2014, it is the home of Pampanga Eye, Loop Roller Coaster, Super Viking and many more exciting rides.',
                'address' => 'San Fernando, Pampanga',
                'latitude' => 15.05395031644,
                'longitude' => 120.6965495794,
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'title' => 'Holy Rosary Parish Church',
                'history' => 'The church was constructed from 1877 to 1896 by the "Polo y Servicio" labor system, defined as the forced and unpaid labor of Filipino males for 40 days per year by the Spanish colonial government. The first mass was held when only half of the church was built on April 14, 1886.',
                'address' => 'Santo Rosario St, Angeles, 2009 Pampanga',
                'latitude' => 15.13481382386,
                'longitude' => 120.5903688273,
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'title' => 'CDC Park',
                'history' => 'The Clark Parade Grounds is among the most frequented places in the Clark area. It hosts sport tourism events and is also used for leisure events such as jogging and cycling. The parade grounds hosts a rubberized 2.2 km (1.4 mi) long 2 m (6.6 ft) wide jogging path. It also hosts facilities for football.',
                'address' => '5GJ9+476, Marcos Village, Mabalacat, Pampanga',
                'latitude' => 15.18049157469,
                'longitude' => 120.5181704101,
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'title' => 'Walking Street',
                'history' => 'Walking Street or Fields Avenue is the name of a major street running through the Balibago area of Angeles City in the Philippines. It is the center of the red light district and the bar scene of the biggest entertainment district of the Philippines.',
                'address' => 'Angeles, Pampanga',
                'latitude' => 15.17001717500,
                'longitude' => 120.5907411218,
                'created_at' => now(),
            ],
        );

        Destination::insert($destinations);

        Destination::all()->each(function($destination) use($service){
            
            // $destination
            // ->addMedia(public_path("/img/tmp_files/destinations/toyota_vios.jpg"))
            // ->preservingOriginal()
            // ->toMediaCollection('featured_photo');

            $destination
            ->addMedia(public_path("/img/tmp_files/destinations/$destination->id.jpg"))
            ->preservingOriginal()
            ->toMediaCollection('featured_photo');

            $service->log_activity(model:$destination, event:'added', model_name: 'Destination', model_property_name: $destination->title);
        });
    }
}