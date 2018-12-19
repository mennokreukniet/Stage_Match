<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{

    public function index(Request $request)
    {
        $base_url = 'http://overpass-api.de/api/interpreter?data=[out:json];relation["admin_level"="2"];out tags;';
        if ($request->id === null) {
            $base_url = 'http://overpass-api.de/api/interpreter?data=[out:json];node["place"~"city|town|village"]["is_in:country_code"="'.$request->id.'"];out;';
        }
        return json_decode(file_get_contents($base_url), true);

    }

    public function getAll()
    {
        $string = Storage::disk('locations')->get('country_list.json');

        $json = json_decode($string, true);

        dd($json);

        $existingCountries = DB::table('users')->distinct()->get();
    }
}




