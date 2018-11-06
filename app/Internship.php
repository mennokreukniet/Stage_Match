<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public $timestamps = false;

    protected $fillable = [
        'title', 'body', 'mentor', 'start_date', 'end_date',
    ];
}
