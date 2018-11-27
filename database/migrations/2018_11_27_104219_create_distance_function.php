<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDistanceFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('          

            DROP FUNCTION IF EXISTS `ST_Distance_Sphere`;
            
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
                ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }



}
