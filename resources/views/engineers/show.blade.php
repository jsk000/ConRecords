@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header">Eng. {{ $engineer->u_first_name }} {{ $engineer->u_surname }}</h4>

    <div class="card-body">

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th scope="row"> Name:</th>
                    <td>
                        {{ $engineer->u_first_name }} {{ $engineer->u_surname }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Username:</th>
                    <td>
                        {{ $engineer->username }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Email:</th>
                    <td>
                        {{ $engineer->u_email }} 
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Telephone:</th>
                    <td>
                        {{ $engineer->u_telefon }}
                    </td>
                </tr>  
                <tr>
                    <th scope="row"> Projects:</th>
                    <td>
                        @foreach($engineer->projects as $project)
                            <a href="{{ route('projects.show', $project) }}">
                                {{$project->p_reference}}
                            </a>
                             &nbsp;
                        @endforeach
                    </td>
                </tr> 
            </tbody>
        </table>
        
        <div class="btn-toolbar">
            @if(auth()->user()->user_id == $engineer->user_id || auth()->user()->is_admin )
                <a class="btn btn-outline-success border-0" href="{{ route('engineers.edit', $engineer) }}" >
                    {{ __('Edit') }}
                </a>
            @endif
            <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
                    {{ __('Back') }}
            </a>
        </div>
        
    </div>

@endsection
