<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompany(Request $request)
    {
        $id = $request->auth["id"];

        $company = Company::where('user_id', $id)
            ->get();

        return json_encode($company[0]);

    }
}
