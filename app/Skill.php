<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $timestamps = false;

    public function students()
    {
        $this->belongsToMany('App\Student');
    }

    public function internships()
    {
        $this->belongsToMany('App\Internship');
    }
}
