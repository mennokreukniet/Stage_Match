<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

define('USER_ROLES', [
    'student' => 1,
    'company' => 2,
    'admin' => 3
]);
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function student() {
        return $this->hasOne('App\Student');
    }

    public function company() {
        return $this->hasOne('App\Company');
    }

    public function user_location() {
        return $this->hasOne('App\User_Location');
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey(); // Eloquent Model method
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'theme' => $this->theme,
        ];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
