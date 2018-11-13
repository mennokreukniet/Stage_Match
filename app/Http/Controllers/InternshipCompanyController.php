<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageFormRequest;
use App\Http\Requests\InternshipFormRequest;
use App\Image;
use App\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternshipCompanyController extends Controller
{
    private $company;
    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            $this->company = $request->user()->company;
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->company->internships()->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        return response($internship->image->toArray());
    }


    public function uploadImage(Internship $internship, ImageFormRequest $request)
    {
        $file = $request->image->store('public/images');
        $image = [
            'name' => $request->image->getClientOriginalName(),
            'url' => Storage::url($file),
            'file' => $file
        ];
        if ($internship->image()->exists()) {
            Storage::delete($internship->image->file);
            if ($internship->image->update($image))
                return $this->response('Image for "'.$internship->title.'" updated');
        } else {
            if ($internship->image()->save(new Image($image)))
                return $this->response('Image for "'.$internship->title.'" added');
        }
        return $this->response("image upload failed", 400);
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

        if ($this->company->internships()->save($internship))
            return response(['message' => 'Internship "'.$internship->title.'" created', 'id' => $internship->id]);

        return $this->response('store new internship failed',400);
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
        if ($this->company->hasInternship($internship)) {
            if ($internship->update($request->all()))
                return response(['message' => 'Internship "'.$internship->title.'" updated', 'id' => $internship->id]);
            return $this->response('internship update failed', 400);
        }
        return $this->response('user '.auth()->user()->email.' does not own this internship',400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Internship  $internship
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Internship $internship)
    {
        if ($this->company->hasInternship($internship)) {
            if ($internship->delete())
                return $this->response('Internship successfully deleted');
        }
        return $this->response('destroy internship failed',400);
    }
    public function response($message, $status = 200) {
        return response(['message' => $message], $status);
    }
}
