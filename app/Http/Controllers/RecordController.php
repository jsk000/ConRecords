<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Media;
use App\Models\Worker;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\NullableType;

class RecordController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('record.access')->only(['edit', 'update', 'show', 'destroy', 'confirmDelete']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {   
        // this part is only accessible to the admin and the assined project manager
        if((Auth::user()->is_admin && $project->c_id == Auth::user()->c_id) || ($project->u_id == Auth::user()->user_id)){
            $records = $project->records->sortByDesc('date');
            return view('records.index', compact('records', 'project'));
        }else{
            return redirect()->back(); // Redirect back to the same page
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        if((Auth::user()->is_admin && $project->c_id == Auth::user()->c_id) || ($project->u_id == Auth::user()->user_id)){
            
            //create a record reference
            $latest_record = $project->records()->latest('record_id')->first(); // Get the latest record within the project
            $project_reference = $project->p_reference; 
            $date = date('d.m.Y'); 
    
            if ($latest_record) {
                $record_number = intval(substr($latest_record->r_reference, -1)) + 1; // Extract the record number and increment it
            } else {
                $record_number = 1; // Set record number to 1 for the first record
            }    
            $r_ref = $project_reference . '/' . $date . '-' . $record_number; // Concatenate the project reference, date, and record number
            
            return view('records.create', compact('project', 'r_ref'));
        }else{
            return redirect()->back(); // Redirect back to the same page
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, Request $request)
    {
        $project_id = $project->project_id;
            
        //validate and store the record information
        $request->validate([
            'r_reference' => ['required', 'string', 'max:255' ],
            'date' => ['required'],
            'time' => ['required'],
            'weather' => ['required', 'string', 'max:255'],
            'temperature' => ['required', 'numeric'],
            'other_involved_party' => ['nullable', 'string', 'max:500'],
            'performed_services' => ['required', 'string', 'max:500'],
            'equipments_materials' => ['required', 'string', 'max:500'],
            'other_events' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);
        $record = Record::create([
            'p_id' => $project_id,
            'r_reference' => $request->r_reference,
            'date' => $request->date,
            'time' => $request->time,
            'weather' => $request->weather,
            'temperature' => $request->temperature,
            'other_involved_party' => $request->other_involved_party,
            'performed_services' => $request->performed_services,
            'equipments_materials' => $request->equipments_materials,
            'other_events' => $request->other_events,
            'notes' => $request->notes,
        ]);
        $record->save();

        //validate and store workers        
        $r_reference = $record->r_reference;
        $r_id = Record::where('r_reference', $r_reference)->where('p_id', $project_id)->value('record_id');
        $worker_data = [];
        $workers_input = $request->input('w_first_name');

        if ($workers_input != null) {

            $workers_count = count($workers_input);
            
            $request->validate([
                'w_first_name.*' => ['required', 'string', 'max:255'],
                'w_surname.*' => ['required', 'string', 'max:255'],
                'start_time.*' => ['required', 'before:end_time.*'],
                'end_time.*' => ['required'],
            ]);

            for ($i = 0; $i < $workers_count; $i++) {
                $worker_data[] = [
                    'w_first_name' => $request->input('w_first_name')[$i],
                    'w_surname' => $request->input('w_surname')[$i],
                    'start_time' => $request->input('start_time')[$i],
                    'end_time' => $request->input('end_time')[$i],
                ];
            }

            foreach ($worker_data as $data) {
                $worker = Worker::create([
                    'r_id' => $r_id,
                    'w_first_name' => $data['w_first_name'],
                    'w_surname' => $data['w_surname'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                ]);
                $worker->save();
            }
        }
        
        return redirect()->route('projects.records.index', compact('project'))->with('success', 'Record added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Record $record)
    {   
        $workers = $record->workers;

        return view('records.show', compact('record', 'project', 'workers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Record $record)
    {
        $workers = $record->workers;

        return view('records.edit', compact('project', 'record', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Record $record)
    {
        $project_id = $project->project_id;
        
        // Validate and update the record information
        $request->validate([
            'r_reference' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
            'weather' => ['required', 'string', 'max:255'],
            'temperature' => ['required', 'numeric'],
            'other_involved_party' => ['nullable', 'string', 'max:500'],
            'performed_services' => ['required', 'string', 'max:500'],
            'equipments_materials' => ['required', 'string', 'max:500'],
            'other_events' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $record->p_id = $project_id;
        $record->r_reference = $request->r_reference;
        $record->date = $request->date;
        $record->time = $request->time;
        $record->weather = $request->weather;
        $record->temperature = $request->temperature;
        $record->other_involved_party = $request->other_involved_party;
        $record->performed_services = $request->performed_services;
        $record->equipments_materials = $request->equipments_materials;
        $record->other_events = $request->other_events;
        $record->notes = $request->notes;

        $record->save();

        // Validate and update workers
        $workers_input = $request->input('w_first_name');
        
        if ($workers_input != null) {
            $workers_count = count($workers_input);
            
            
            $request->validate([
                'w_first_name.*' => ['required', 'string', 'max:255'],
                'w_surname.*' => ['required', 'string', 'max:255'],
                'start_time.*' => ['required'],
                'end_time.*' => ['required'],
            ]);

            $record->workers()->delete(); // Remove existing workers

            for ($i = 0; $i < $workers_count; $i++) {
                $record->workers()->create([
                    'w_first_name' => $request->input('w_first_name')[$i],
                    'w_surname' => $request->input('w_surname')[$i],
                    'start_time' => $request->input('start_time')[$i],
                    'end_time' => $request->input('end_time')[$i],
                ]);
            }
        } else {
            $record->workers()->delete(); // Remove existing workers if all workers are removed
        }

        return redirect()->route('projects.records.show', compact('project', 'record'))->with('success', 'Record updated successfully.');
    }


    /**
     * Show a confirmation pop-up before deleting the resource.
     */
    public function destroy(Project $project, Record $record)
    {
        return view('records.delete', compact('project', 'record'));
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete(Project $project, Record $record)
    {
        $record->delete();

        return redirect()->route('projects.records.index', compact('project', 'record'))->with('success', 'Record deleted successfully.');
    }
}
