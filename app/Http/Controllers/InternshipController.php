<?php

namespace App\Http\Controllers;

use App\Internship;
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
        return json_encode(Internship::paginate(25));
    }


    /**
     * Store a newly created resource in storage.
     * POST /api/internship
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $internship = new Internship();
        #$internship->fill($request); is better right?
        $internship->company = $request->company;
        $internship->mentor = $request->mentor;
        $internship->period = $request->period;

        $created = $internship->save();

        if ($created) {
            return response(['status' => 'success', 'result' => $internship], 200);
        }
        return response(['status' => 'error'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        return json_encode($internship);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Internship $internship)
    {
        //
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
