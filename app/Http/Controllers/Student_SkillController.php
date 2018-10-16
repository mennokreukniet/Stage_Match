<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\User;
use App\Student;


class Student_SkillController extends Controller
{
    /**
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

        $added = $student->skills()->save($skill);

        if ($added) {
            return response(['status' => 'success', 'result' => $skill], 200);
        } else {
            return response(['status' => 'error'], 400);
        }
    }
}
