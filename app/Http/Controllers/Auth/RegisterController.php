<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'u_first_name' => ['required', 'string', 'max:255'],
            'u_surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'u_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'u_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            'password' => ['required', 'string', 'confirmed',
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'c_name' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        //get the company name from the passed data
        $company_name = $data['c_name']; 

        //retrieve the company information from the session and save in the db
        Session::get('company')->save();

        //get the company id from the db
        $company_id = Company::where('c_name', $company_name)->value('company_id'); //get the company id from the db

        return User::create([
            'u_first_name' => $data['u_first_name'],
            'u_surname' => $data['u_surname'],
            'username' => $data['username'],
            'u_email' => $data['u_email'],
            'u_telefon' => $data['u_telefon'],
            'password' => Hash::make($data['password']),
            //'is_admin' => true, //the dafault value is true
            'c_id' => $company_id,
        ]); 

        
    }
}
