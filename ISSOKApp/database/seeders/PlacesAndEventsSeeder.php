<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\Event;
use Carbon\Carbon;



class PlacesAndEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array of sample places
        $places = [
            [
                'name' => 'Cafe Latte',
                'address' => '123 Main St',
                'city' => 'New York',
                'phone' => '123-456-7890',
                'description' => 'A cozy cafe with great coffee and ambience.',
                'image' => null,
                'category' => 'cafe',
            ],
            [
                'name' => 'The Club House',
                'address' => '456 Club Ave',
                'city' => 'New York',
                'phone' => '234-567-8901',
                'description' => 'Experience the best nightlife in town.',
                'image' => null,
                'category' => 'club',
            ],
            [
                'name' => 'Pizza Paradise',
                'address' => '789 Pizza Rd',
                'city' => 'Los Angeles',
                'phone' => '345-678-9012',
                'description' => 'Delicious pizzas and pastas served hot.',
                'image' => null,
                'category' => 'restaurant',
            ],
        ];

        foreach ($places as $placeData) {
            // Create the place
            $place = Place::create($placeData);

            // Create two upcoming events for each place
            Event::create([
                'place_id'    => $place->id,
                'title'       => 'Grand Opening Event',
                'description' => 'Join us for the grand opening celebration!',
                'event_date'  => Carbon::now()->addDays(rand(1, 10)), // event scheduled within the next 10 days
                'event_image' => null,
            ]);

            Event::create([
                'place_id'    => $place->id,
                'title'       => 'Special Discount Weekend',
                'description' => 'Enjoy exclusive discounts and offers this weekend.',
                'event_date'  => Carbon::now()->addDays(rand(11, 20)), // event scheduled within the next 11-20 days
                'event_image' => null,
            ]);
        }
    }
}
