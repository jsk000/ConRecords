@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header d-flex justify-content-between align-items-center">Projects 
        @if (auth()->user()->is_admin)
            <a class="btn btn-outline-secondary border-0" href="{{ route('projects.create') }}"> <i class="bi bi-house-add-fill fs-4"></i> Add new Project</a> 
        @endif   
    </h4>

    <div class="card-body">

        @if ($projects->isEmpty())
            <p> There are no projects assigned to this company!</p>
        @else
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Name</th>
                        <th>Manager</th>
                        <th>Owner</th>
                        <th>Records</th>
                        <th>Operations</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>
                                <a href="{{ route('projects.show', $project) }}" style="color: grey;"> 
                                    {{$project->p_reference}}
                                </a> 
                            </td>
                            <td> 
                                {{$project->p_name}}
                            </td>
                            <td> 
                                {{$project->user->u_first_name}} {{$project->user->u_surname}}
                            </td>
                            <td> 
                                {{$project->owner_first_name}} {{$project->owner_surname}}
                            </td>
                            <td> 
                                @if(auth()->user()->user_id == $project->user->user_id || auth()->user()->is_admin )
                                    <a href="{{ route('projects.records.index', $project) }}" style="color: grey;"> 
                                        {{$records_count[$project->project_id]}}
                                    </a>
                                @else
                                    {{$records_count[$project->project_id]}}
                                @endif
                            </td>
                           
                            <td>
                                <div class="btn-toolbar">
                                    @if(auth()->user()->user_id == $project->user->user_id || auth()->user()->is_admin )
                                        <a href="{{ route('projects.records.index', $project) }}" class="btn btn-outline-primary border-0">{{ __('Records') }}</a>
                                    @endif
                                    @if (auth()->user()->is_admin)

                                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-success border-0">{{ __('Edit') }}</a>

                                        <form method="POST" action="{{ route('projects.destroy', $project) }}">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger border-0">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endif        
                                </div>
                            </td>
                            
                        </tr>
                        
                    @endforeach
                
                </tbody>
            </table>
        @endif

        <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
            {{ __('Back') }}
        </a>
    </div>

@endsection
