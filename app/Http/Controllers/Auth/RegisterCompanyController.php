<?php

namespace App\Http\Controllers\Auth;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth/register-company');
    }


    /**
     * Store a newly created resource in session and redirect
     * to user registration.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'c_name' => ['required', 'string', 'max:255'],
            'c_email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'c_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            'c_street' => ['required', 'string', 'max:255'],
            'c_house_no' => ['required', 'string', 'max:255'],
            'c_postal_code' => ['required', 'string', 'max:255', 'digits:5'],
            'c_city' => ['required', 'string', 'max:255'],
        ]);
        
        $company = new Company;

        $company->c_name = $request->input('c_name');       
        $company->c_email = $request->input('c_email');
        $company->c_telefon = $request->input('c_telefon'); 
        $company->c_street = $request->input('c_street'); 
        $company->c_house_no = $request->input('c_house_no'); 
        $company->c_postal_code = $request->input('c_postal_code'); 
        $company->c_city = $request->input('c_city'); 

        // Start the session
        Session::put('company', $company);
        
        //store in variable to pass it to view
        $company_name = $company->c_name; 

        return view('auth.register', compact('company_name'));

    }

}
