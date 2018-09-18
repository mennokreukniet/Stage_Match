<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\User;
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
	    $user->password = bcrypt($request->password);
	    $user->save();
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
	    return response([
	            'status' => 'success',
	            'token' => $token
	        ]);
	}
}
