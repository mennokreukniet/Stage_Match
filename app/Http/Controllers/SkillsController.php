<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class SkillsController extends Controller
{
    public function createSkill(Request $request){
    	$skill = new Skill;

    	$skill->name = $request->name;

    	$skill->save();
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

    	return json_encode($skill);
    }

    public function getAll(Request $request){

    	$skills = Skill::all();

    	return json_encode($skills);
    }

}
