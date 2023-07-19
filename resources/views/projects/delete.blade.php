@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ __('Delete') }} {{ $project->p_name }}</h4>

    <div class="card-body">
        <p class="card-subtitle text-muted">
            By deleting the project, all the the stored 
            information including the corresponding records, will be deleted from our servers
            and can not be restored.
        </p> <br>

        <p>Are you sure you want to delete {{ $project->p_name }} (Ref. {{ $project->p_reference}})?</p>
        <form method="POST" action="{{ route('projects.confirmDelete', $project) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary ms-3">No</a>
        </form>
    </div>
@endsection