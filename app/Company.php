<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Get the user for the company.
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
    /**
     * Get the internships for the company.
     */
    public function internships()
    {
        return $this->hasMany('App\Internship');
    }
}
}
