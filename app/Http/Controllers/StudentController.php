<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudent(Request $request)
    {
        $id = $request->auth["id"];

        $student = Student::where('user_id', $id)
            ->get();

        return json_encode($student[0]);

    }
}
