<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mentor' => 'string|max:191',
            'title' => 'required|string|max:191',
            'body' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date'
        ];
    }
}