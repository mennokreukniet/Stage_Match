<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

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
                    'name' => $request->name,
                    'theme' => $request->theme]);

        $signer = new Sha256();
        $token = (new Builder())->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
                                ->set('id', $id)
                                ->set('name', $request->name)
                                ->set('role', $token->getClaim('role'))
                                ->set('email', $request->email)
                                ->set('theme', $request->theme)
                                ->sign($signer, 'your-256-bit-secret') // DIE SIGNATURE MOET JE NOG VERANDEREN PIK
                                ->getToken(); // Retrieves the generated token

        return response([
            'status' => 'success',
            'token' => (string)$token
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
