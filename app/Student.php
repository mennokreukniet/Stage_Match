<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'student_skill')->withPivot('level');
    }

    /*public function levels(){
        return $this->belongsToMany('App\Level', 'student_skill');
    }*/

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



    public $timestamps = false;
}
