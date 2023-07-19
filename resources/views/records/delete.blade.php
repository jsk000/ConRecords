@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ __('Delete') }} {{ $record->r_reference }}</h4>

    <div class="card-body">
        <p class="card-subtitle text-muted">
            By deleting the record, all the the stored 
            information, will be deleted from our servers
            and can not be restored.
        </p> <br>

        <p>Are you sure you want to delete {{ $record->r_reference }} (Date: {{ $record->date}})?</p>
        <form method="POST" action="{{ route('projects.records.confirmDelete', [$project, $record]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="{{ route('projects.records.index', $project) }}" class="btn btn-secondary ms-3">No</a>
        </form>
    </div>
@endsection