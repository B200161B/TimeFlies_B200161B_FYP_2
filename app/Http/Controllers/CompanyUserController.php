<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Auth;
use Illuminate\Http\Request;

class CompanyUserController extends Controller
{
    public function index()
    {

        $companyId = Auth::guard('companyStaff')->user()->companies_id;

        $company = Company::query()
            ->with('users')
            ->find($companyId);

//        dd($company);
//        return response()->json($company);


        return view('Company.Users.index',compact('company'));
    }
}
