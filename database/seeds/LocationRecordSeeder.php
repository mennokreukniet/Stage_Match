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
       
        $NL_locations = json_decode(File::get("country_records/NL.json"));
        foreach($NL_locations as $_location) {
            $location = new Location();
            $location->name = $_location->name;
            $location->type = $_location->type;
            $location->country_name = $_location->country->name;
            $location->country_code = $_location->country->code;
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