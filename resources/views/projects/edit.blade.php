@extends('layouts.dashboard')

@section('content')

        <h4 class="card-header">{{ __('Edit') }} {{ $project->p_name }}</h4>

        <div class="card-body">
            <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="p_reference" class="col-md-4 col-form-label text-md-end">{{ __('Project Reference') }}</label>
                <div class="col-md-6">
                    <input id="p_reference" type="text" class="form-control" name="p_reference" value="{{ old('p_reference', $project->p_reference) }}" required autocomplete="on">
                </div>
            </div>

            <div class="row mb-3">
                <label for="p_name" class="col-md-4 col-form-label text-md-end">{{ __('Project Name or Description') }}</label>
                <div class="col-md-6">
                    <input id="p_name" type="text" class="form-control" name="p_name" value="{{ old('p_name', $project->p_name) }}" required autocomplete="on">
                </div>
            </div>
        
            <div class="row mb-3">
                <label for="p_street" class="col-md-4 col-form-label text-md-end">{{ __('Street Address') }}</label>
                <div class="col-md-6">
                    <input id="p_street" type="text" class="form-control" name="p_street" value="{{ old('p_street', $project->p_street) }}" required autocomplete="street-address">
                </div>
            </div>

            <div class="row mb-3">
                <label for="p_house_no" class="col-md-4 col-form-label text-md-end">{{ __('House No.') }}</label>
                <div class="col-md-6">
                    <input id="p_house_no" type="text" class="form-control" name="p_house_no" value="{{ old('p_house_no', $project->p_house_no) }}" required autocomplete="on">
                </div>
            </div>

            <div class="row mb-3">
                <label for="p_postal_code" class="col-md-4 col-form-label text-md-end">{{ __('Postal Code') }}</label>
                <div class="col-md-6">
                    <input id="p_postal_code" type="text" class="form-control" name="p_postal_code" value="{{ old('p_postal_code', $project->p_postal_code) }}" required autocomplete="postal-code">
                </div>
            </div>

            <div class="row mb-3">
                <label for="p_city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
                <div class="col-md-6">
                    <input id="p_city" type="text" class="form-control" name="p_city" value="{{ old('p_city', $project->p_city) }}" required autocomplete="on">
                </div>
            </div>

            <div class="row mb-3">
                <label for="engineer" class="col-md-4 col-form-label text-md-end">{{ __('Project Manager') }}</label>
                <div class="col-md-6">
                    <select id="engineer" class="form-select" name="engineer" required autocomplete="on">
                        <option class="dropdown-item" value="{{ $project->user->user_id }}" selected>{{ $project->user->u_first_name }} {{ $project->user->u_surname }}</option>
                        @foreach($engineers as $engineer)
                            <option class="dropdown-item" value="{{ $engineer->user_id }}">{{ $engineer->u_first_name }} {{ $engineer->u_surname }}</option>
                        @endforeach
                    </select>               
                </div>
            </div>

            <div class="row mb-3">
                <label for="owner_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Owner First Name') }}</label>
                <div class="col-md-6">
                    <input id="owner_first_name" type="text" class="form-control" name="owner_first_name" value="{{ old('owner_first_name', $project->owner_first_name) }}" required autocomplete="name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="owner_surname" class="col-md-4 col-form-label text-md-end">{{ __('Owner Surname') }}</label>
                <div class="col-md-6">
                    <input id="owner_surname" type="text" class="form-control" name="owner_surname" value="{{ old('owner_surname', $project->owner_surname) }}" required autocomplete="family-name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="o_email" class="col-md-4 col-form-label text-md-end">{{ __('Owner Email') }}</label>
                <div class="col-md-6">
                    <input id="o_email" type="email" class="form-control" name="o_email" value="{{ old('o_email', $project->o_email) }}" required autocomplete="email">
                </div>
            </div>

            <div class="row mb-3">
                <label for="o_telefon" class="col-md-4 col-form-label text-md-end">{{ __('Owner Telephone') }}</label>

                <div class="col-md-6">
                    <input id="o_telefon" type="tel" class="form-control" name="o_telefon" value="{{ old('o_telefon', $project->o_telefon) }}" required autocomplete="tel">
                </div>
            </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button> 
                                <a class="ms-4 btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>

                
                </form> 
        </div>


@endsection