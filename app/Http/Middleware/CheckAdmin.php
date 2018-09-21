<?php

namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;


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
       // dd($request->header('Authorization'));
        //Bearer TOKEN
        $token = explode(' ', $request->header('Authorization'))[1];
        
        $token = (new Parser())->parse($token); // Parses from a string
        $data = new ValidationData();
        
        if($token->validate($data)) {
            if ($token->getClaim("role") ==="3") {
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
                'error' => ['msg' => 'token invallid']
            ]);
            }

        
    }    
}
