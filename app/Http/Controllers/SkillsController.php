<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\User;

class SkillsController extends Controller
{
    /**
     * Creates a new skill.
     *
     * Adds a new skill to the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function createSkill(Request $request){
    	$skill = new Skill();

    	$skill->name = $request->name;

		$created = $skill->save();
		
		if ($created) {
			return response(['status' => 'success', 'result' => [$skill]], 200);
		} else {
			return response(['status' => 'error'], 400);
		}
    }

    /**
     * Edit an existing skill.
     *
     * Finds the skill you want to edit by id, then changes it to the string the user
     * types into the form
     *
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
     * Delete a skill.
     *
     * Removes a skill from the database by id.
     *
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
     * Get a single skill.
     *
     * Gets a single skill from the database by id.
     *
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
     * Get all skills.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getAll(Request $request){

		$skills = Skill::all();

        return response(['status' => 'success', 'result' => array_reverse($skills->toArray())], 200);
    }

    /**
     * Search a skill by name.
     *
     * Runs a 'where like' query to compare your search input to all skills in the
     * database, then returns all similar named skills.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function searchSkill(Request $request){

        $skill = Skill::where('name', 'like', '%' . $request->keyword . '%')->get();

        return response(['status' => 'success', 'result' => $skill], 200);
    }

}
