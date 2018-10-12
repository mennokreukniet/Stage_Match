<?php

namespace App\Http;

use App\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class CreateToken
{
    /**
     *
     * checks the user role to determine what token to create
     *
     * @param $email
     * @return string
     */
    public static function createToken($email){
        $signer = new Sha256();
        $user = User::where('email', $email)
            ->get();

            $token = (new Builder())->setExpiration(time() + 3600)
            ->set('id', $user[0]->id)
                ->set('name', $user[0]->name)
                ->set('role', $user[0]->role)
                ->set('theme', $user[0]->theme)
                ->sign($signer, 'your-256-bit-secret')
                ->getToken();

        return (string)$token;
    }
}