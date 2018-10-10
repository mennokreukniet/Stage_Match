<?php

namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Auth
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

        $token = (new Parser())->parse($token); // Parses from a string
        $data = new ValidationData();

        if($token->validate($data)) {
            $request["auth"] = $token.getClaims();
            dd($request);
            return $next($request);
        } else {
            return response([
                'status' => 'error',
                'error' => ['msg' => 'token invallid']
            ]);
        }

    }
}
