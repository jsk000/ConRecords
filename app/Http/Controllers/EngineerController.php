<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class EngineerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //the middleware only applies on specific functions
        $this->middleware('engineer.access')->only(['edit', 'update', 'destroy', 'confirmDelete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Auth::user()->company;
        $engineers = $company->users;

        return view('engineers.index', compact('engineers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->is_admin){
            return view('engineers.create');
        }else{
            return redirect()->back(); // Redirect back to the same page if the user is not admin 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company_id = Auth::user()->c_id;

        $request->validate([
            'u_first_name' => ['required', 'string', 'max:255'],
            'u_surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'u_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'u_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            'password' => ['required', 'string', 
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
        ]);

        $engineer = new User();
        $engineer->u_first_name = $request->u_first_name;
        $engineer->u_surname = $request->u_surname;
        $engineer->username = $request->username;
        $engineer->u_email = $request->u_email;
        $engineer->u_telefon = $request->u_telefon;
        $engineer->password = Hash::make($request->password);
        $engineer->c_id = $company_id;
        $engineer->is_admin = false;

        $engineer->save();

        return redirect()->route('engineers.index')->with('success', 'Engineer created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $engineer)
    {
        //check if the requested engineer belongs to the same company as the current user
        if(Auth::user()->c_id === $engineer->c_id){
            return view('engineers.show', compact('engineer'));
        }else{
            return redirect()->back(); // Redirect back to the same page
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $engineer)
    {
        return view('engineers.edit', compact('engineer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $engineer)
    {
        $request->validate([
            'u_first_name' => ['required', 'string', 'max:255'],
            'u_surname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'u_email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'u_email')->ignore($engineer)], //ignore unique-rule for current engineer
            'u_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            
        ]);

        $engineer->u_first_name = $request->u_first_name;
        $engineer->u_surname = $request->u_surname;
        $engineer->username = $request->username;
        $engineer->u_email = $request->u_email;
        $engineer->u_telefon = $request->u_telefon;
        
        
        $engineer->save();

        return redirect()->route('engineers.index')->with('success', 'Engineer updated successfully.');
    }

    /**
     * Show a confirmation pop-up before deleting the resource.
     */
    public function destroy(User $engineer)
    {
        
        return view('engineers.delete', compact('engineer'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete(User $engineer)
    {
        $engineer->delete();

        return redirect()->route('engineers.index')->with('success', 'Engineer deleted successfully.');
    }
}
