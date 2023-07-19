@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ __('Delete') }} {{ $engineer->u_first_name }} {{ $engineer->u_surname }}</h4>

    <div class="card-body">
        <p class="card-subtitle text-muted">
            By deleting the the user's account, all the the stored 
            information including the records they wrote, will be deleted from our servers
            and can not be restored.
        </p> <br>

        <p>Are you sure you want to delete the account of {{ $engineer->u_first_name }} {{ $engineer->u_surname }}?</p>
        <form method="POST" action="{{ route('engineers.confirmDelete', $engineer) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="{{ route('engineers.index') }}" class="btn btn-secondary ms-3">No</a>
        </form>
    </div>
@endsection