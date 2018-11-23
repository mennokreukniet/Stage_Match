<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{

    public function index()
    {
        return json_decode(file_get_contents('http://overpass-api.de/api/interpreter?data=[out:json];node["place"~"city|town|village"]["is_in:country_code"="NL"];out;'), true);

    }
}
