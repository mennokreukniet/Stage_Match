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
        function add_distance_function() {
            $check_function = `SELECT COUNT(*) AS found
            FROM information_schema.routines
            WHERE routine_name = 'ST_Distance_Sphere'`;

            $sql = '
              

            CREATE FUNCTION `ST_Distance_Sphere` (point1 POINT, point2 POINT)

            RETURNS FLOAT
            no sql deterministic
            BEGIN
                declare R INTEGER DEFAULT 6371000;
                declare `φ1` float;
                declare `φ2` float;
                declare `Δφ` float;
                declare `Δλ` float;
                declare a float;
                declare c float;
                set `φ1` = radians(y(point1));
                set `φ2` = radians(y(point2));
                set `Δφ` = radians(y(point2) - y(point1));
                set `Δλ` = radians(x(point2) - x(point1));

                set a = sin(`Δφ` / 2) * sin(`Δφ` / 2) + cos(`φ1`) * cos(`φ2`) * sin(`Δλ` / 2) * sin(`Δλ` / 2);
                set c = 2 * atan2(sqrt(a), sqrt(1-a));

                return R * c;
            END;
                ';

            DB::connection()->getPdo()->exec($sql);
        }


        // $mysql_version_check = DB::select(DB::raw('SHOW VARIABLES LIKE "version";'));
        // $mysql_version = $mysql_version_check[0]->Value;

        // if (strpos($mysql_version, 'MariaDB') === false) {
        //     if () {}
        // } else {

        // }
        add_distance_function();

        
        
        

            

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