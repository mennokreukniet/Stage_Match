<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\User;

class SkillsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createSkill(Request $request){
    	$skill = new Skill;

    	$skill->name = $request->name;

		$created = $skill->save();
		
		if ($created) {
			return response(['status' => 'success', 'result' => [$skill]], 200);
		} else {
			return response(['status' => 'error'], 400);
		}
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function editSkill(Request $request){
        $skill = Skill::find($request->id);

        $skill->name = $request->name;

        $edited = $skill->save();

        if ($edited) {
            return response(['status' => 'success', 'result' => [$skill]], 200);
        } else {
            return response(['status' => 'error'], 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteSkill(Request $request){

    	$destroyed = Skill::destroy($request->id);

    	if ($destroyed == true){
    		return response(['status' => 'success'], 200);
    	} else {
    		return response(['status' => 'error'], 404);
    	}
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getSkill(Request $request){

    	$skill = Skill::find($request->id);

        if ($skill != null) {
            return response(['status' => 'success', 'result' => [$skill]], 200);
        } else {
            return response(['status' => 'error'], 404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getAll(Request $request){

		$skills = Skill::all();

        return response(['status' => 'success', 'result' => array_reverse($skills->toArray())], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function searchSkill(Request $request){

        $skill = Skill::where('name', 'like', '%' . $request->keyword . '%')->get();

        return response(['status' => 'success', 'result' => $skill], 200);
    }

}
