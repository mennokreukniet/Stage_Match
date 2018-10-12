<?php

namespace App\Http\Controllers;

use App\Http\Token;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Company;

class UserController extends Controller
{
    public function editUser(Request $request){
       $id = $request->auth["id"];
       $role = $request->auth["role"];

        User::where('id', $id)
    		->update(['email' => $request->email,
                    'name' => $request->name,
                    'theme' => $request->theme,
                    'city' => $request->city,
                    'street' => $request->street,
                    'house_number' => $request->house_number]);

        if ($role == 1){
            Student::where('user_id', $id)
                ->update(['school' => $request->school,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender]);
        } elseif ($role === "2"){
            Company::where('user_id', $id)
                ->update(['description' => $request->description]);
        };

        $user = User::where('email', $request->email)->get();

        $token = Token::create($user[0]);

        return response([
            'status' => 'success',
            'token' => (string)$token
        ]);
    }

    public function getUser(Request $request){
       $id = $request->auth["id"];

       $user = User::where('id', $id)
       		->get();

       	return json_encode($user[0]);
    }
}
