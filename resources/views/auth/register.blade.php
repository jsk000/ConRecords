@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register Admin for {{ $company_name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="u_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Name *') }}</label>

                            <div class="col-md-6">
                                <input id="u_first_name" type="text" class="form-control @error('u_first_name') is-invalid @enderror" name="u_first_name" value="{{ old('u_first_name') }}" required autocomplete="given-name">

                                @error('u_first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname *') }}</label>

                            <div class="col-md-6">
                                <input id="u_surname" type="text" class="form-control @error('u_surname') is-invalid @enderror" name="u_surname" value="{{ old('u_surname') }}" required autocomplete="family-name">

                                @error('u_surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username *') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address *') }}</label>

                            <div class="col-md-6">
                                <input id="u_email" type="email" class="form-control @error('u_email') is-invalid @enderror" name="u_email" value="{{ old('u_email') }}" required autocomplete="email">

                                @error('u_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_telefon" class="col-md-4 col-form-label text-md-end">{{ __('Telephone *') }}</label>

                            <div class="col-md-6">
                                <input id="u_telefon" type="tel" class="form-control @error('u_telefon') is-invalid @enderror" name="u_telefon" value="{{ old('u_telefon') }}" required autocomplete="tel">

                                @error('u_telefon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <input type="hidden" id="c_name" name="c_name" value="{{ $company_name }}">

                        <p class="text-muted px-1"> * Required </p>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
