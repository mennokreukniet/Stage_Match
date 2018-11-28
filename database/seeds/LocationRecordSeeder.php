<?php

use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Location; 

class LocationRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $locations = json_decode(File::get("locations/country-nl.json"));
        foreach($locations as $_location) {
            $location = new Location();
            $location->name = $_location->city;
            $location->country_code = strtoupper($_location->country);
            $location->coordinates = new Point($_location->coordinates->lat, $_location->coordinates->long);	// (lat, lng)
            
            $location->save();
        }


        // DB::table('location_record')->insert([
        //     'name' => $_location->name,
        //     'type' => $_location->type,
        //     'coordinates' => new Point(10, 10),
        //     'country_name' => $_location->country->name,
        //     'country_code' => $_location->country->code,
        //     'country_continent' => $_location->country->continent
        // ]);

      

    }
}