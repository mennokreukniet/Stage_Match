<?php

namespace App\Http\Middleware;

use App\Http\Token;
use Closure;


class CheckAdmin 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = explode(' ', $request->header('Authorization'))[1];

        $token = Token::verify($token);
        
        if($token["is_valid"]) {
            if ($token["claims"]["role"] == "3") {
                $request["auth"] = $token["claims"];
                return $next($request);
            } else {
                return response([
                'status' => 'error',
                'error' => ['msg' => 'not permitted']
            ]);
            }
        } else {
                return response([
                'status' => 'error',
                'error' => ['msg' => 'token invalid']
            ]);
        }
    }    
}
