<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $id = auth()->payload()->get('sub');
        $role = auth()->payload()->get('role');
        if ($role == '1') {
            return [
                'name' => 'required|integer',
                'email' => 'required|email|unique:users,email,'.$id,
                'theme' => 'required|integer',
                'city' => 'required|string',
                'street' => 'required|string',
                'house_number' => 'required|integer',
                'school' => 'required|string',
            ];
         } else if ($role == '2') {
             return [
                 'name' => 'required|integer',
                 'email' => 'required|email|unique:users',
                 'theme' => 'required|integer',
                 'city' => 'required|string',
                 'street' => 'required|string',
                 'house_number' => 'required|integer',
                 'description' => 'required|string',
             ];
         } else if ($role == '3') {
             return [
                 'name' => 'required|integer',
                 'email' => 'required|email|unique:users',
                 'theme' => 'required|integer',
                 'city' => 'required|string',
                 'street' => 'required|string',
                 'house_number' => 'required|integer',
             ];
         }
    }

}