@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ __('Delete') }} {{ $company->c_name }}</h4>

    <div class="card-body">
        <p class="card-subtitle text-muted">
            By deleting the the company's account, all the the stored 
            information including the records will be deleted from our servers
            and can not be restored.
        </p> <br>

        <p>Are you sure you want to delete the account of {{ $company->c_name }}?</p>
        <form method="POST" action="{{ route('company.confirmDelete', $company) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="{{ route('company.index') }}" class="btn btn-secondary ms-3">No</a>
        </form>
    </div>
@endsection