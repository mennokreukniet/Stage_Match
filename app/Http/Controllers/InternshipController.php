<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternshipFormRequest;
use App\Internship;
use App\User;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(auth()->user()->company->internships()->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        return response($internship);
    }


    /**
     * Store a newly created resource in storage.
     * POST /api/internship
     * @param InternshipFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternshipFormRequest $request)
    {
        $internship = new Internship($request->all());
        $company = auth()->user()->company;
        $internship->company()->associate($company);
        if ($internship->save()) {
            return response(['status' => 'success', 'result' => $internship], 200);
        }
        return response(['status' => 'error'], 400);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param InternshipFormRequest $request
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function update(InternshipFormRequest $request, Internship $internship)
    {
        $internship->fill($request->all())->save();
        return response($internship);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        $destroyed = Internship::destroy($internship);

        if ($destroyed == true){
            return response(['status' => 'success'], 200);
        }
        return response(['status' => 'error'], 404);

    }
}
