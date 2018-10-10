<?php

namespace App\Http;

use App\Student;
use App\Company;
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


        if ($user[0]->role == 1) {
            $student = Student::where('user_id', $user[0]->id)
                ->get();

            $token = (new Builder())->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
            ->set('id', $user[0]->id)
                ->set('name', $user[0]->name)
                ->set('role', $user[0]->role)
                ->set('email', $user[0]->email)
                ->set('theme', $user[0]->theme)
                ->set('city', $user[0]->city)
                ->set('street', $user[0]->street)
                ->set('house_number', $user[0]->house_number)
                ->set('school', $student[0]->school)
                ->set('date_of_birth', $student[0]->date_of_birth)
                ->set('gender', $student[0]->gender)
                ->sign($signer, 'your-256-bit-secret')// DIE SIGNATURE MOET JE NOG VERANDEREN PIK
                ->getToken(); // Retrieves the generated token

        } elseif ($user[0]->role == 2){
            $company = Company::where('user_id', $user[0]->id)
                ->get();

            $token = (new Builder())->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
            ->set('id', $user[0]->id)
                ->set('name', $user[0]->name)
                ->set('role', $user[0]->role)
                ->set('email', $user[0]->email)
                ->set('theme', $user[0]->theme)
                ->set('city', $user[0]->city)
                ->set('street', $user[0]->street)
                ->set('house_number', $user[0]->house_number)
                ->set('description', $company[0]->description)
                ->sign($signer, 'your-256-bit-secret')// DIE SIGNATURE MOET JE NOG VERANDEREN PIK
                ->getToken(); // Retrieves the generated token

        } else {

            $token = (new Builder())->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
            ->set('id', $user[0]->id)
                ->set('name', $user[0]->name)
                ->set('role', $user[0]->role)
                ->set('email', $user[0]->email)
                ->set('theme', $user[0]->theme)
                ->set('city', $user[0]->city)
                ->set('street', $user[0]->street)
                ->set('house_number', $user[0]->house_number)
                ->sign($signer, 'your-256-bit-secret')// DIE SIGNATURE MOET JE NOG VERANDEREN PIK
                ->getToken(); // Retrieves the generated token
        }
        return (string)$token;
    }
}