<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class ProjectController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('project.access')->only(['edit', 'update', 'destroy', 'confirmDelete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::user();
        $company = $current_user->company;
        $projects = $company->projects
        ->sortBy(function ($project) use ($current_user) { //projects of current user will be shown first
            return $project->user->user_id === $current_user->user_id ? 0 : 1;
        });
        $records_count = $projects->mapWithKeys(function ($project) {
            return [$project->project_id => $project->records->count()];
        });

        return view('projects.index', compact('projects', 'records_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Auth::user()->company;
        $engineers = $company->users;

        //create a project reference
        $company_name = substr($company->c_name, 0, 3);

        // Get the latest project within the company
        $latest_project = Project::where('c_id', $company->company_id)->latest('project_id')->first(); 
        
        if ($latest_project) {
            // Extract the project number and increment it
            $project_number = intval(substr($latest_project->p_reference, -4)) + 1; 
        } else {
            // Set project number to 1 for the first project
            $project_number = 1; 
        }

        // Concatenate the company name and project number with padding
        $p_ref = $company_name . '-' . str_pad($project_number, 4, '0', STR_PAD_LEFT); 

        // ensure that only admins can add new projects
        if(Auth::user()->is_admin){
            return view('projects.create', compact('engineers', 'p_ref'));
        }else{
            return redirect()->back(); // Redirect back to the same page
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company_id = Auth::user()->c_id;
        $user_id = $request->engineer; //responsible project manager

        $request->validate([
            'p_reference' => ['required', 'string', 'max:255', Rule::unique('projects', 'p_reference')->where('c_id', $company_id)], //unique rule only applies in the company
            'p_name' => ['required', 'string', 'max:255'],
            'p_street' => ['required', 'string', 'max:255'],
            'p_house_no' => ['required', 'string', 'max:255'],
            'p_postal_code' => ['required', 'string', 'max:255', 'digits:5'],
            'p_city' => ['required', 'string', 'max:255'],
            'owner_first_name' => ['required', 'string', 'max:255'],
            'owner_surname' => ['required', 'string', 'max:255'],
            'o_email' => ['required', 'string', 'email', 'max:255'],
            'o_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            
        ]);

        $project = new Project();
        $project->c_id = $company_id;
        $project->u_id = $user_id;
        $project->p_reference = $request->p_reference;
        $project->p_name = $request->p_name;
        $project->p_street = $request->p_street; 
        $project->p_house_no = $request->p_house_no; 
        $project->p_postal_code = $request->p_postal_code; 
        $project->p_city = $request->p_city; 
        $project->p_street = $request->p_street;
        $project->owner_first_name = $request->owner_first_name;
        $project->owner_surname = $request->owner_surname;
        $project->o_email = $request->o_email;
        $project->o_telefon = $request->o_telefon;
        
        $project->save();

        return redirect()->route('projects.index')->with('success', 'project added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        if(Auth::user()->c_id === $project->c_id){
            $records = $project->records;
            $records_count = $records->count();
            return view('projects.show', compact('project', 'records_count'));
        }else{
            return redirect()->back(); // Redirect back to the same page
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $company = Auth::user()->company;
        $engineers = $company->users;

        return view('projects.edit', compact('project', 'engineers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $user_id = $request->engineer; //responsible project manager

        $updated_project = $request->validate([
            'p_reference' => ['required', 'string', 'max:255'],
            'p_name' => ['required', 'string', 'max:255'],
            'p_street' => ['required', 'string', 'max:255'],
            'p_house_no' => ['required', 'string', 'max:255'],
            'p_postal_code' => ['required', 'string', 'max:255', 'digits:5'],
            'p_city' => ['required', 'string', 'max:255'],
            'owner_first_name' => ['required', 'string', 'max:255'],
            'owner_surname' => ['required', 'string', 'max:255'],
            'o_email' => ['required', 'string', 'email', 'max:255'],
            'o_telefon' => ['required', 'string', 'max:255', 'digits_between:8,15'],
            
        ]);

        $project->update($updated_project);

        return redirect()->route('projects.index')->with('success', 'project updated successfully.');

    }

    /**
     * Show a confirmation pop-up before deleting the resource.
     */
    public function destroy(Project $project)
    {
        return view('projects.delete', compact('project'));
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
