@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">{{ $project->p_name }}</h4>

    <div class="card-body">

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th scope="row"> Ref.:</th>
                    <td>
                        {{ $project->p_reference }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Name:</th>
                    <td>
                        {{ $project->p_name }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Street:</th>
                    <td>
                        {{ $project->p_street }}
                    </td>
                </tr>  
                <tr>
                    <th scope="row"> House No.:</th>
                    <td>
                        {{ $project->p_house_no }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Postal Code:</th>
                    <td>
                        {{ $project->p_postal_code }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> City:</th>
                    <td>
                        {{ $project->p_city }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Manager:</th>
                    <td>
                        <a href="{{ route('engineers.show', $project->user) }}" style="text-decoration:none;"> 
                            {{$project->user->u_first_name}} {{$project->user->u_surname}}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Owner:</th>
                    <td>
                        {{ $project->owner_first_name }} {{ $project->owner_surname }}
                    </td>
                </tr>  
                <tr>
                    <th scope="row"> Owner Email:</th>
                    <td>
                        {{ $project->o_email }} 
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Owner Telephone:</th>
                    <td>
                        {{ $project->o_telefon }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Records:</th>
                    <td>
                        @if(auth()->user()->user_id == $project->user->user_id || auth()->user()->is_admin )
                            <a href="{{ route('projects.records.index', $project) }}" style="text-decoration:none;"> 
                                {{$records_count}}
                            </a>
                        @else
                            {{$records_count}}
                        @endif
                    </td>
                </tr>  
                
            </tbody>
        </table>
        <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
            {{ __('Back') }}
        </a>
        
    </div>

@endsection
