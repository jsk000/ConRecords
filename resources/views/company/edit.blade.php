@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ __('Edit') }} {{ $company->c_name }}</h4>

    <div class="card-body">
        <form method="POST" action="{{ route('company.update', $company) }}">
        @csrf
        @method('PUT')
            <div class="row mb-3">
                <label for="c_name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>
                <div class="col-md-6">
                    <input id="c_name" type="text" class="form-control" name="c_name" value="{{ old('c_name', $company->c_name) }}" required autocomplete="organization">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                    <input id="c_email" type="email" class="form-control" name="c_email" value="{{ old('c_email', $company->c_email) }}" required autocomplete="email">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_telefon" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>
                <div class="col-md-6">
                    <input id="c_telefon" type="tel" class="form-control" name="c_telefon" value="{{ old('c_telefon', $company->c_telefon) }}" required autocapitalize="tel">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_street" class="col-md-4 col-form-label text-md-end">{{ __('Street Adress') }}</label>
                <div class="col-md-6">
                    <input id="c_street" type="text" class="form-control" name="c_street" value="{{ old('c_street', $company->c_street) }}" required autocomplete="street-address">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_house_no" class="col-md-4 col-form-label text-md-end">{{ __('House No.') }}</label>
                <div class="col-md-6">
                    <input id="c_house_no" type="text" class="form-control" name="c_house_no" value="{{ old('c_house_no', $company->c_house_no) }}" required autocomplete="on">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_postal_code" class="col-md-4 col-form-label text-md-end">{{ __('Postal Code') }}</label>
                <div class="col-md-6">
                    <input id="c_postal_code" type="text" class="form-control" name="c_postal_code" value="{{ old('c_postal_code', $company->c_postal_code) }}" required autocomplete="postal-code">
                </div>
            </div>

            <div class="row mb-3">
                <label for="c_city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
                <div class="col-md-6">
                    <input id="c_city" type="text" class="form-control" name="c_city" value="{{ old('c_city', $company->c_city) }}" required autocomplete="on">
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