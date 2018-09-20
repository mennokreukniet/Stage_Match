<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function editUser(Request $request){
    	User::where('id', $request->id)
    		->update(['email' => $request->email,
    				  'name' => $request->name]);
    }
}
