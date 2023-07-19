@extends('layouts.dashboard')

@section('content')

    <h4 class="card-header"> Record {{ $record->r_reference }} of {{ $project->p_name}}</h4>

    <div class="card-body">

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th scope="row"> Ref.:</th>
                    <td>
                        {{ $record->r_reference }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Date and Time:</th>
                    <td>
                        {{ $record->date }}, {{ $record->time }}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Weather:</th>
                    <td>
                       Condition: {{ $record->weather }}, Temperature: {{ $record->temperature}}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> present Workers:</th>
                    <td>
                        @forelse($workers as $worker)
                            {{ $worker->w_first_name }} {{ $worker->w_surname }} from {{ $worker->start_time}} to {{ $worker->end_time}} 
                            <br>
                        @empty
                            No workers were present in this day.
                        @endforelse
                    </td>
                </tr>    
                <tr>
                    <th scope="row"> Other involved Party:</th>
                    <td>
                        {{ $record->other_involved_party }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Performed Services:</th>
                    <td>
                        {{ $record->performed_services }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Equipments and Materials:</th>
                    <td>
                        {{ $record->equipments_materials }}
                    </td>
                </tr> 
                <tr>
                    <th scope="row"> Other Events:</th>
                    <td>
                        {{$record->other_events}}
                    </td>
                </tr>
                <tr>
                    <th scope="row"> Notes:</th>
                    <td>
                        {{ $record->notes }} 
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="btn-toolbar">
            <a class="btn btn-outline-success border-0" href="{{ route('projects.records.edit',  [$project, $record]) }}" >
                {{ __('Edit') }}
            </a>

            <a class="btn btn-outline-secondary border-0" href="{{ URL::previous() }}">
                    {{ __('Back') }}
            </a>
        </div>
        
    </div>

@endsection
