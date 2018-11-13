<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\Student;
use App\Student_Skill;
use App\User;


class Student_SkillController extends Controller
{


    /**
     * Add a skill to an user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addSkill(Request $request){
        $student = auth()->user()->student;

        $skill = Skill::find($request->id);

        if ($skill->id === NULL) {
            return response(['status' => 'error', "message" => "Skill does not exist"], 404);
        }

        try {
            $student->skills()->attach($request->id);
            return response(['status' => 'success', 'result' => $skill], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            return response(['status' => 'error', "message" => "Skill is already added"], 400);
        }
    }

    /**
     * Select the skill level for a skill that has been added to an user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function skillLevel(Request $request){
        $student = auth()->user()->student;

        $sync = $student->skills()->updateExistingPivot($request->id, ['level' => $request->level ]);

        if ($sync) {
            return response(['status' => 'success', 'result' => $sync], 200);
        }
    }

    /**
     * Delete a skill from an user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteSkill(Request $request) {
        $student = auth()->user()->student;

        $detach = $student->skills()->detach($request->id);

        if ($detach){
            return response(['status' => 'success'], 200);
        }
    }
}
