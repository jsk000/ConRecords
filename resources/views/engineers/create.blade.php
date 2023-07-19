@extends('layouts.dashboard')


@section('content')

        <h4 class="card-header">{!! "Add Engineer to the Company's Account" !!}</h4>

        <div class="card-body">
                <!-- <p class="card-subtitle text-muted">
                        After the registration an Email with login information will be sent to inform the user.
                </p> -->

                <form method="POST" action="{{ route('engineers.store') }}">
                @csrf
                        <div class="row mb-3">
                            <label for="u_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="u_first_name" type="text" class="form-control" name="u_first_name" value="{{ old('u_first_name') }}" required autocomplete="given-name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_surname" class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="u_surname" type="text" class="form-control" name="u_surname" value="{{ old('u_surname') }}" required autocomplete="family-name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="u_email" type="email" class="form-control" name="u_email" value="{{ old('u_email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="u_telefon" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="u_telefon" type="tel" class="form-control" name="u_telefon" value="{{ old('u_telefon') }}" required autocomplete="tel">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Engineer') }}
                                </button>
                                <a class="ms-4 btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                </form>

        
        </div>


@endsection