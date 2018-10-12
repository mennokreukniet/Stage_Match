<?php

namespace App\Http;

use App\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Token
{
    /**
     *
     * checks the user role to determine what token to create
     *
     * @param $email
     * @return string
     */
    public static function create($user){
        $signer = new Sha256();

        $token = (new Builder())->setExpiration(time() + 3600)
        ->set('id', $user->id)
            ->set('name', $user->name)
            ->set('role', $user->role)
            ->set('theme', $user->theme)
            ->sign($signer, 'your-256-bit-secret')
            ->getToken();

        return (string)$token;
    }
}