<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageFormRequest;
use App\Http\Requests\InternshipFormRequest;
use App\Image;
use App\Internship;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Internship as InternshipResource;

/**
 * Class InternshipCompanyController
 * @package App\Http\Controllers
 */
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
     * @returns \App\Http\Resources\Internship
     */
    public function index()
    {
        return InternshipResource::collection(
            $this->company
                 ->internships()
                 ->latest()
                 ->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Internship  $internship
     * @return \App\Http\Resources\Internship
     */
    public function show(Internship $internship)
    {
        return new InternshipResource($internship);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InternshipFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternshipFormRequest $request)
    {
        $internship = new Internship($request->all());

        if ($this->company->internships()->save($internship)) {
            if ($request->input('skills')) {
                foreach ($request->input('skills') as $skill) {
                    $skill = Skill::find($skill['id']);
                    $internship->skills()->save($skill);
                }
            }
            return $this->response('Internship "' . $internship->title . '" created', 200, ['id' => $internship->id]);
        }

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
            $internship->update($request->all());

            if ($request->hasFile('image')) {
                $image = $this->storeImage($request->image);

                if ($internship->image()->exists()) Storage::delete($internship->image->file);

                $internship->image->update($image);
            }

            return $this->response('Internship "'.$internship->title.'" updated', 200, ['id' => $internship->id]);
        }
        return $this->unauthorized();
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
            $name = $internship->name;
            if ($internship->delete())
                return $this->response("Internship {$name} successfully deleted");
            return $this->response('destroy internship failed',400);
        }
        return $this->unauthorized();
    }

    /**
     * updates or stores internship image
     *
     * @param Internship $internship
     * @param ImageFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Internship $internship, ImageFormRequest $request)
    {
        $path = $request->image->store('public/images');

        $image = [
            'name' => $request->image->getClientOriginalName(),
            'url' => Storage::url($path),
            'file' => $path
        ];

        if ($internship->image()->exists()) {
            Storage::delete($internship->image->path);

            if ($internship->image->update($image))
                return $this->response('Image for "'.$internship->title.'" updated');

        } else {

            if ($internship->image()->save(new Image($image)))
                return $this->response('Image for "'.$internship->title.'" added');

        }
        return $this->response("image upload failed", 400);
    }



    protected function unauthorized()
    {
        return $this->response('user '.auth()->user()->email.' does not own this internship',403);
    }
    protected function response($message, $status = 200, $extra = [])
    {
        return response(array_merge(['message' => $message], $extra), $status);
    }
}
