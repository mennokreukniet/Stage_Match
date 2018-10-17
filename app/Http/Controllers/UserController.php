<?php

namespace App\Http\Controllers;

use App\Http\Token;
use App\Skill;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Company;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function editUser(Request $request){
       $id = $request->auth["id"];
       $role = $request->auth["role"];

        User::where('id', $id)
    		->update(['email' => $request->email,
                    'name' => $request->name,
                    'theme' => $request->theme,
                    'city' => $request->city,
                    'street' => $request->street,
                    'house_number' => $request->house_number]);

        if ($role == '1'){
            Student::where('user_id', $id)
                ->update(['school' => $request->school,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender]);
        } elseif ($role === "2"){
            Company::where('user_id', $id)
                ->update(['description' => $request->description]);
        };

        $user = User::where('email', $request->email)->get();

        $token = Token::create($user[0]);

        return response([
            'status' => 'success',
            'token' => (string)$token
        ]);
    }

    public function getUser(Request $request){

        $id = $request->auth["id"];
        $role = $request->auth["role"];

        if ($role == '1'){
           $user = Student::where('user_id', $id)
               ->join('users', 'students.user_id', '=', 'users.id')
               ->select('users.role', 'users.id', 'users.name', 'users.email', 'users.theme', 'users.city', 'users.street', 'users.house_number', 'students.id AS student_id',
                   'students.school', 'students.date_of_birth', 'students.gender')
               ->get();

           $skills = DB::table('student_skill')
                ->where('student_id', $user[0]->student_id)
                ->join('skills', 'skills.id', '=', 'student_skill.skill_id')
                ->select('student_skill.skill_id AS id', 'skills.name', 'student_skill.level')
                ->get();

           $user[0]->skills = $skills;

        } elseif ($role == '2'){
            $user = Company::where('user_id', $id)
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->select('users.role', 'users.id', 'users.name', 'users.email', 'users.theme', 'users.city', 'users.street', 'users.house_number', 'companies.description')
                ->get();
        } else {
            $user = User::where('id', $id)
                ->select('users.role', 'users.id', 'users.name', 'users.email', 'users.theme', 'users.city', 'users.street', 'users.house_number')
                ->get();
        };

        return response([
            'status' => 'success',
            'user' => $user[0],
        ], 200);
    }
}
