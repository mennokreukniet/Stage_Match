<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Location;

class MatchController extends Controller
{


    public function calculateInternshipScores() {

        $id = auth()->payload()->get('sub');
        $student = Student::where('user_id', $id)->get();
        $results = Internship::all();
        $skillPoints = 500;
        $pointsPerSkill = 50;
        $levelStep = 20;

        //dd($student[0]->skills);

        foreach ($results as $result){
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

                    var_dump($skillPoints);

                }
            }
        }
    }

    function skillInArray($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
    }
}
