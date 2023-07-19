@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header d-flex justify-content-between align-items-center">Records of {{ $project->p_name }}
        <a class="btn btn-outline-secondary border-0" href="{{ route('projects.records.create', $project) }}"> <i class="bi bi-file-earmark-plus-fill fs-4"></i> Add new Record</a>    
    </h4>

    <div class="card-body">

        @if ($records->isEmpty())
            <p> There are no records assigned to this project!</p>
        @else
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Date</th>
                        <th>Performed Services</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>
                                <a href="{{ route('projects.records.show', [$project, $record]) }}"> 
                                    {{ $record->r_reference }}
                                </a> 
                            </td>
                            <td> 
                                {{ $record->date }}
                            </td>
                            <td> 
                                {{ $record->performed_services }}
                            </td>
                            <td>
                                <div class="btn-toolbar">
                                    <a href="{{ route('projects.records.edit', [$project, $record]) }}" class="btn btn-outline-success border-0">{{ __('Edit') }}</a>

                                    <form method="POST" action="{{ route('projects.records.destroy', [$project, $record]) }}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger border-0">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    
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
