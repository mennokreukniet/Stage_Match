<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\Student;


class Student_SkillController extends Controller
{
    /**
     * Add a skill to an user.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addSkill(Request $request){
        if ($request->auth['role'] != "1") {
            return response(['status' => 'error', "message" => "Incorrect role"], 403);
        }

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
}
