<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Token;
use App\User;
use App\Student;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
	{
	    $user = new User;
	    $user->email = $request->email;
	    $user->name = $request->name;
	    $user->role = $request->role;
        $user->city = $request->city;
        $user->street = $request->street;
        $user->house_number = $request->house_number;
	    $user->password = bcrypt($request->password);
	    $user->save();
	   // dd($user->id);
	    if($request->role == 1){
            $student = new Student;
            $student->user_id = $user->id;
            $student->school = $request->school;
            $student->date_of_birth = $request->date_of_birth;
            $student->gender = $request->gender;
            $student->save();
        } elseif($request->role == 2){
            $company = new Company;
            $company->user_id = $user->id;
            $company->description = $request->description;
            $company->save();
        }

	    $login = $this->login($request);
	    $token = json_decode($login->content());
	    return response([
	        'status' => 'success',
	        'token' => $token->token,
	       ], 200);
	}

	public function login(Request $request)
	{
	    $credentials = $request->only('email', 'password');
	    if ( ! $token = JWTAuth::attempt($credentials)) {
	            return response([
	                'status' => 'error',
	                'error' => 'invalid.credentials',
	                'msg' => 'Invalid Credentials.'
	            ], 400);
	    }

        $user = User::where('email', $request->email)->get();

	    #$token = Token::create($user[0]);

	    return response([
	            'status' => 'success',
	            'token' => $token
	        ]);
	}

	public function logout()
	{
	    JWTAuth::invalidate();
	    return response([
	            'status' => 'success',
	            'msg' => 'Logged out Successfully.'
	        ], 200);
	}
}
	/*
    public function register(RegisterFormRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        if($user->role == USER_ROLES['student']){
            $user->student()->save(new Student($request->all()));
        } elseif($user->role == USER_ROLES['company']){
            $user->company()->save(new Company($request->all()));
        }

        return $this->login($request);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (! $token = auth()->attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
	*/