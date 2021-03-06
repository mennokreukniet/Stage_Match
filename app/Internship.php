<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Internship extends Model
{
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill')->withPivot('level', 'mandatory');
    }

    protected $fillable = [
        'title', 'body', 'mentor', 'start_date', 'end_date',
    ];

    public $with = ['image', 'skills'];
}
