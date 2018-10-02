<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function getJWTIdentifier() {
        return $this->getKey(); // Eloquent Model method
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return ['id' => $this->id,
            'school' => $this->school,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
        ];
    }
}
