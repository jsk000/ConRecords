@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register your Company') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register-company.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="c_name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name *') }}</label>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control @error('c_name') is-invalid @enderror" name="c_name" value="{{ old('c_name') }}" required autocomplete="organization">

                                @error('c_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address *') }}</label>

                            <div class="col-md-6">
                                <input id="c_email" type="email" class="form-control @error('c_email') is-invalid @enderror" name="c_email" value="{{ old('c_email') }}" required autocomplete="email">

                                @error('c_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_telefon" class="col-md-4 col-form-label text-md-end">{{ __('Telephone *') }}</label>

                            <div class="col-md-6">
                                <input id="c_telefon" type="tel" class="form-control @error('c_telefon') is-invalid @enderror" name="c_telefon" value="{{ old('c_telefon') }}" required autocapitalize="tel">

                                @error('c_telefon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_street" class="col-md-4 col-form-label text-md-end">{{ __('Street Adress *') }}</label>

                            <div class="col-md-6">
                                <input id="c_street" type="text" class="form-control @error('c_street') is-invalid @enderror" name="c_street" value="{{ old('c_street') }}" required autocomplete="street-address">

                                @error('c_street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_house_no" class="col-md-4 col-form-label text-md-end">{{ __('House No. *') }}</label>

                            <div class="col-md-6">
                                <input id="c_house_no" type="text" class="form-control @error('c_house_no') is-invalid @enderror" name="c_house_no" value="{{ old('c_house_no') }}" required autocomplete="on">

                                @error('c_house_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_postal_code" class="col-md-4 col-form-label text-md-end">{{ __('Postal Code *') }}</label>

                            <div class="col-md-6">
                                <input id="c_postal_code" type="text" class="form-control @error('c_postal_code') is-invalid @enderror" name="c_postal_code" value="{{ old('c_postal_code') }}" required autocomplete="postal-code">

                                @error('c_postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="c_city" class="col-md-4 col-form-label text-md-end">{{ __('City *') }}</label>

                            <div class="col-md-6">
                                <input id="c_city" type="text" class="form-control @error('c_city') is-invalid @enderror" name="c_city" value="{{ old('c_city') }}" required autocomplete="on">

                                @error('c_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p class="text-muted px-1"> * Required </p>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection
