<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //the middleware only applies on specific functions
        $this->middleware('company.access')->only(['edit', 'update', 'destroy', 'confirmDelete']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Auth::user()->company;
        $engineers = $company->users;
        $engineers_count = $engineers->count();
        $projects = $company->projects;
        $projects_count = $projects->count();

        return view('company.index', compact('company', 'engineers_count', 'projects_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'c_name' => ['required', 'string', 'max:255'],
            'c_email' => ['required', 'string', 'email', 'max:255', Rule::unique('companies', 'c_email')->ignore($company)], //ignore unique-rule for current company
            'c_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            'c_street' => ['required', 'string', 'max:255'],
            'c_house_no' => ['required', 'string', 'max:255'],
            'c_postal_code' => ['required', 'string', 'max:255', 'digits:5'],
            'c_city' => ['required', 'string', 'max:255'],
        ]);
        
        $company->c_name = $request->c_name;       
        $company->c_email = $request->c_email;
        $company->c_telefon = $request->c_telefon; 
        $company->c_street = $request->c_street; 
        $company->c_house_no = $request->c_house_no; 
        $company->c_postal_code = $request->c_postal_code; 
        $company->c_city = $request->c_city; 

        $company->save();

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');

    }

    /**
     * Show a confirmation pop-up before deleting the resource.
     */
    public function destroy(Company $company)
    {
        return view('company.delete', compact('company'));
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete(Company $company)
    {
        $company->delete();

        return redirect()->route('welcome')->with('success', 'Account deleted successfully.');
    }
}
