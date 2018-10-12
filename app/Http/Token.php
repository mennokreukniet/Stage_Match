<?php

namespace App\Http;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class Token
{
    /**
     *
     * checks the user role to determine what token to create
     *
     * @param $user
     * @return string
     */
    public static function create($user){
        $signer = new Sha256();

        $token = (new Builder())->setExpiration(time() + 3600)
        ->set('id', $user->id)
            ->set('name', $user->name)
            ->set('role', $user->role)
            ->set('theme', $user->theme)
            ->sign($signer, env("JWT_SECRET") )
            ->getToken();

        return (string)$token;
    }


    /**
     *
     * Verify's token and returns headers and claims
     *
     * @param $token
     * @return array
     */

    public static function verify($token) {
        $token = (new Parser())->parse($token);
        $data = new ValidationData();

        if ($token->validate($data)) {
            return [
                "is_valid" => true,
                "headers" => $token->getHeaders(),
                "claims" => $token->getClaims()
            ];
        }

        return [
            "is_valid" => false
        ];
    }
}