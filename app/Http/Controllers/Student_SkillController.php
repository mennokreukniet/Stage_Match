<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\Student;
use App\Student_Skill;
use App\User;


class Student_SkillController extends Controller
{

    function __construct(Request $request)
    {
        if ($request->auth['role'] != "1") {
            return response(['status' => 'error', "message" => "Incorrect role"], 403);
        }
    }

    /**
     * Add a skill to an user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addSkill(Request $request){
        $user_id = $request->auth['id'];
        $student = Student::where('user_id', $user_id)->first();

        $skill = Skill::find($request->id);

        if ($skill === NULL) {
            return response(['status' => 'error', "message" => "Skill does not exist"], 404);
        }

        try {
            $student->skills()->attach($skill->id);
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
        $user_id = $request->auth['id'];
        $student = Student::where('user_id', $user_id)->first();

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

        $user_id = $request->auth['id'];
        $student = Student::where('user_id', $user_id)->first();

        $detach = $student->skills()->detach($request->id);

        if ($detach){
            return response(['status' => 'success'], 200);
        }
    }
}
