<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

class UserController extends Controller
{
    public function editUser(Request $request){
    	//dd($request);
    	$token = explode(' ', $request->header('Authorization'))[1];

    	//dd($token);
        
        $token = (new Parser())->parse($token); // Parses from a string
        $data = new ValidationData();

       $id = $token->getClaim("id");

    	User::where('id', $id)
    		->update(['email' => $request->email,
    				  'name' => $request->name]);

    	return response([
	            'status' => 'success'
	        ]);
    }

    public function getUser(Request $request){
    	$token = explode(' ', $request->header('Authorization'))[1];
        
        $token = (new Parser())->parse($token); // Parses from a string
        $data = new ValidationData();

       $id = $token->getClaim("id");

       $user = User::where('id', $id)
       		->get();

       	return json_encode($user[0]);
    }
}
