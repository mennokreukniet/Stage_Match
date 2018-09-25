<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class SkillsController extends Controller
{
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

    public function editSkill(Request $request){
        $skill = Skill::find($request->name);
        dd($skill);
        $skill->name = $request->name;

        $edited = $skill->save();

        if ($edited) {
            return response(['status' => 'success', 'result' => [$skill]], 200);
        } else {
            return response(['status' => 'error'], 400);
        }
    }

    public function deleteSkill(Request $request){
    	$destroyed = Skill::destroy($request->id);

    	if ($destroyed == true){
    		return response(['status' => 'success'], 200);
    	} else {
    		return response(['status' => 'error'], 404);
    	}
    }

    public function getSkill(Request $request){

    	$skill = Skill::find($request->id);

        if ($skill != null) {
            return response(['status' => 'success', 'result' => [$skill]], 200);
        } else {
            return response(['status' => 'error'], 400);
        }
    }

    public function getAll(Request $request){

		$skills = Skill::all();

        if ($skills != null) {
            return response(['status' => 'success', 'result' => [array_reverse($skills->toArray())]], 200);
        } else {
            return response(['status' => 'error'], 400);
        }
    }

}
