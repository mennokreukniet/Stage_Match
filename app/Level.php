<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

define('LEVELS', [
    'moderate' => 1,
    'good' => 2,
    'expert' => 3
]);
class Level extends Model
{
    public function students()
    {
        //$this->belongsToMany('App\Student');
    }
}
