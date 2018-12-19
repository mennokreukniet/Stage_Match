<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Student;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Location;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{

    public function test(Builder $query){



        $locations = (DB::select("
     SELECT id FROM `location_record` WHERE ST_Distance_sphere(coordinates, Point(?, ?)) < 10000
   ", [
            4.683325,
            51.799002,
        ]));

        foreach ($locations as $location){
            $cities[] = $location->id;
        }

        dd($cities);
       // dd(Location::wherein('id', $cities)->get());

        dd(Internship::whereHas('company.user.user_location', function($query){
            $query->wherein('id', $this->cities);
        })->get());

        foreach ($results as $result){
            dd('hoi');

        }


       // $results = Internship::where('ST_Distance_sphere(coordinates, Point(4.683325, 51.799002))', '<', 10000)->get;

      /*  dd(DB::select("
     SELECT id, name, ST_Distance_sphere(coordinates, Point(?, ?)) as lol, country_code FROM `location_record` WHERE ST_Distance_sphere(coordinates, Point(?, ?)) < 10000
   ", [
            4.683325,
            51.799002,
             4.683325,
             51.799002,
        ]));*/
    }


    public function calculateInternshipScores() {

        $id = auth()->payload()->get('sub');
        $student = Student::where('user_id', $id)->get();
        $results = Internship::has('skills')->get();
        $pointsPerSkill = 50;
        $levelStep = 20;
        $matchedInternships = null;


        foreach ($results as $result){
            $skillPoints = 500;

            foreach ($result->skills as $skill) {
                if ($skill->pivot->level == 4 /*niet verplicht*/) {
                    foreach ($student[0]->skills as $student_skill){
                        if ($student_skill->id == $skill->id){
                            //dd($skill->name);
                            $skillPoints += ($pointsPerSkill * 0.6);
                            var_dump($skillPoints);
                        }
                    }

                } else {

                    $key = $this->skillInArray($skill->id, $student[0]->skills);
                    if (isset($key)){
                        if ($skill->pivot->level == $student[0]->skills[$key]->pivot->level){
                            $skillPoints += $pointsPerSkill;
                        } elseif ($skill->pivot->level > $student[0]->skills[$key]->pivot->level) {
                            $skillPoints -= ($skill->pivot->level - $student[0]->skills[$key]->pivot->level) * $levelStep;
                        } else {
                            $skillPoints += (3 - ($student[0]->skills[$key]->pivot->level - $skill->pivot->level)) * $levelStep;
                        }
                    } else {

                       $skillPoints -= $pointsPerSkill;
                    }

                }
            }
            $result->matchPoints = $skillPoints;
            $matchedInternships[] = $result;

        }
        return json_encode($matchedInternships);

    }

    function skillInArray($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
    }
}
