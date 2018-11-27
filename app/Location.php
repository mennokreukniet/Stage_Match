<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Location extends Model
{   
    protected $table = 'location_record';
    use SpatialTrait;

    protected $fillable = [
        'name',
        'type',
        'country_code',
        'country_name',
    ];

    protected $spatialFields = [
        'coordinates'
    ];

    public $timestamps = false;
}
