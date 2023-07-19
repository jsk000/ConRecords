@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header d-flex justify-content-between align-items-center">Engineers 
        @if (auth()->user()->is_admin)
            <a class="btn btn-outline-secondary border-0" href="{{ route('engineers.create') }}"> <i class="bi bi-person-plus-fill fs-4"></i> Register new Engineer</a> 
        @endif   
    </h4>

    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Projects</th>
                    @if (auth()->user()->is_admin)
                        <th>Operations</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($engineers as $engineer)
                    <tr>
                        <td>
                            <a href="{{ route('engineers.show', $engineer) }}" style="text-decoration:none;"> 
                                {{$engineer->u_first_name }} {{ $engineer->u_surname }}
                            </a> 
                            <!-- Admin Tag -->
                            @if ($engineer->is_admin)
                                <p> (Admin) </p>
                            @endif
                        </td>
                        <td> 
                            @foreach($engineer->projects as $project)
                            <a href="{{ route('projects.show', $project) }}">
                                Ref. {{$project->p_reference}}, <br> 
                            </a>
                            @endforeach
                            
                        </td>
                        @if (auth()->user()->is_admin)
                            <td>
                                <div class="btn-toolbar">
                                    <a href="{{ route('engineers.edit', $engineer) }}" class="btn btn-outline-success border-0">{{ __('Edit') }}</a>

                                    <!-- admins should not be deleted -->
                                    @if ($engineer->is_admin != 1)
                                    <form method="POST" action="{{ route('engineers.destroy', $engineer) }}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger border-0">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                    
                @endforeach
               
            </tbody>
        </table>
        <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
            {{ __('Back') }}
        </a>
    </div>

@endsection
