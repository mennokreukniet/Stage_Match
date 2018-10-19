<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\Student;
use App\Student_Skill;


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

    public function skillLevel(Request $request){
        if ($request->auth['role'] != "1") {
            return response(['status' => 'error', "message" => "Incorrect role"], 403);
        }

        $student_skill = Student_Skill::find($request->id);

        $student_skill->level = $request->level;

        $added = $student_skill->save();

        if($added){
            return response(['status' => 'success', 'result' => $student_skill], 200);
        }else{
            return response(['status' => 'error', "message" => "error"], 400);
        }
    }
}
