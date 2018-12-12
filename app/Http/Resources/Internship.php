<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Internship extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->mentor,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'skills' => Skill::collection($this->whenLoaded('skills'))
            ];
    }
}
