@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ $company->c_name}}</h4>

    <div class="card-body">

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th scope="row"> Registered Name:</th>
                    <td>
                        {{ $company->c_name }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Email Address:</th>
                    <td>
                        {{ $company->c_email }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Telephone:</th>
                    <td>
                        {{ $company->c_telefon }} 
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Street:</th>
                    <td>
                        {{ $company->c_street }}
                    </td>
                </tr>  
                <tr>
                    <th scope="row"> House No.:</th>
                    <td>
                        {{ $company->c_house_no }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Postal Code:</th>
                    <td>
                        {{ $company->c_postal_code }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> City:</th>
                    <td>
                        {{ $company->c_city }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Registered Engineers:</th>
                    <td>
                        <a href="{{ route('engineers.index') }}">
                             {{ $engineers_count }}
                        </a>
                       
                    </td>
                </tr>  
                <tr>
                    <th scope="row"> Projects:</th>
                    <td>
                        <a href="{{ route('projects.index') }}">
                             {{ $projects_count }}
                        </a>
                    </td>
                </tr> 
            </tbody>
        </table>
        @if (auth()->user()->is_admin)
            <div class="btn-toolbar">
                <a href="{{ route('company.edit', $company) }}" class="btn btn-outline-success border-0">
                    {{ __('Edit') }}
                </a>

                <form method="POST" action="{{ route('company.destroy', $company) }}">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger border-0">
                        {{ __('Delete Account') }}
                    </button>
                </form>

                <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
                    {{ __('Back') }}
                </a>
            </div>
            
        @endif
        
    </div>

@endsection
