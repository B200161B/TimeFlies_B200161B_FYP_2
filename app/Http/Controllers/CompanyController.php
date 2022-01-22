<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyStaff;
use App\Models\Workspaces;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    use RegistersUsers;


    public function index()
    {
        $workspaces = Workspaces::query()
        ->with('inChargePerson')
        ->get();
//        admin@Test1.com
    //        evVy1tmc

        return view('Company.home',[
        'workspaces'=>$workspaces
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:company']
        ]);
    }

    public function registerPage()
    {
        return view('Company/auth/register');
    }

    public function registerStore(Request $request)
    {
        $companyName = $request->input('company_name');
        $company = Company::create([
            'company_name' => $companyName,
            'email' => $request->input('email')
        ]);


        $password = Str::random(8);

        $companyStaff = CompanyStaff::create([
            'name' => $companyName . '_admin',
            'email' => 'admin@' . $companyName . '.com',
            'password' => Hash::make($password),
            'companies_id' => $company->id
        ]);
        return redirect()->route('company.login.page')->with([
            'email' => $companyStaff->email,
            'password' => $password,
        ]);
    }

    public function loginPage()
    {
        return view('Company/auth/login');
    }

    public function loginCheck(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::guard('companyStaff')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //Authentication passed...
            return redirect()
                ->intended(route('company.home'))
                ->with('status', 'You are Logged in as Admin!');
        }
//        $loginStaff = CompanyStaff::query()
//            ->where('email',$email)
//            ->where('password',Hash::check($password))
//            ->first();
//        if($loginStaff)
//        {
//
//        }


    }

    public function logout ()
    {
        Auth::guard('companyStaff')->logout();
        return redirect()
            ->route('company.login.page')
            ->with('status','Admin has been logged out!');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
