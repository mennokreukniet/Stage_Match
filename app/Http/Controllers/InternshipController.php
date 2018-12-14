<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternshipFormRequest;
use App\Internship;
use Illuminate\Http\Request;
use App\Http\Resources\Internship as InternshipResource;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Internship::paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        return new InternshipResource($internship);
    }
}
