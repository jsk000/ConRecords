@extends('layouts.dashboard')

@section('content')

        <h4 class="card-header">{{ __('Edit') }} {{ $record->r_reference }}</h4>

        <div class="card-body">
            <form method="POST" action="{{ route('projects.records.update', [$project, $record]) }}">
            @csrf
            @method('PUT')

                <div class="row mb-3">
                    <label for="r_reference" class="col-md-2 col-form-label text-md-start">{{ __('Record Reference') }}</label>
                    <div class="col-md-6">
                        <input id="r_reference" type="text" class="form-control" name="r_reference" value="{{ old('r_reference', $record->r_reference) }}" required autocomplete="on">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="date" class="col-form-label text-md-start">{{ __('Date') }}</label>
                        <input id="date" type="date" class="form-control" name="date" value="{{ old('date', $record->date) }}" required autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="time" class="col-form-label text-md-start">{{ __('Time') }}</label>
                        <input id="time" type="time" class="form-control" name="time" value="{{ old('time', $record->time) }}" required autocomplete="off">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="weather" class="col-form-label text-md-start">{{ __('Weather') }}</label>
                        <input id="weather" type="text" class="form-control" name="weather" value="{{ old('weather', $record->weather) }}" required autocomplete="on">
                    </div>
                    <div class="col-md-4">
                        <label for="temperature" class="col-form-label text-md-start">{{ __('Temperature') }}</label>
                        <input id="temperature" type="number" class="form-control" name="temperature" value="{{ old('temperature', $record->temperature) }}" required autocomplete="on">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="workers" class="col-md-2 col-form-label text-md-start">{{ __('Present Workers') }}</label>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-secondary border-0" onclick="addWorkerField()">
                            <i class="bi bi-person-plus-fill fs-4"></i> {{ __('Add Worker') }}
                        </button>
                    </div>
                </div>

                <div id="workers-container">
                    @forelse ($workers as $worker)
                    <fieldset>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="w_first_name" class="col-form-label text-md-start">{{ __('Worker First Name') }}</label>
                                <input type="text" class="form-control" name="w_first_name[]" value="{{ old('w_first_name', $worker->w_first_name) }}" required autocomplete="given-name">
                            </div>
                            <div class="col-md-4">
                                <label for="w_surname" class="col-form-label text-md-start">{{ __('Worker Surname') }}</label>
                                <input type="text" class="form-control" name="w_surname[]" value="{{ old('w_surname', $worker->w_surname) }}" required autocomplete="family-name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="start_time" class="col-form-label text-md-start">{{ __('Start Working Time') }}</label>
                                <input type="time" class="form-control" name="start_time[]" value="{{ old('start_time', $worker->start_time) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="end_time" class="col-form-label text-md-start">{{ __('End Working Time') }}</label>
                                <input type="time" class="form-control" name="end_time[]" value="{{ old('end_time', $worker->end_time) }}" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-danger border-0" onclick="removeWorkerField(this)">Remove</button>
                    </fieldset>
                    @empty
                        No workers were present in this day.
                    @endforelse
                </div>

                <div class="row mb-3">
                    <label for="performed_services" class="col-md-2 col-form-label text-md-start">{{ __('Performed Services') }}</label>
                    <div class="col-md-6">
                        <textarea id="performed_services" type="text" class="form-control" name="performed_services" required autocomplete="on">{{ old('performed_services', $record->performed_services) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="equipments_materials" class="col-md-2 col-form-label text-md-start">{{ __('Equipments and Materials') }}</label>
                    <div class="col-md-6">
                        <textarea id="equipments_materials" type="text" class="form-control" name="equipments_materials" required autocomplete="on">{{ old('equipments_materials', $record->equipments_materials) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="other_involved_party" class="col-md-2 col-form-label text-md-start">{{ __('Other Involved Party/Company') }}</label>
                    <div class="col-md-6">
                        <textarea id="other_involved_party" type="text" class="form-control" name="other_involved_party" autocomplete="on">{{ old('other_involved_party', $record->other_involved_party) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="other_events" class="col-md-2 col-form-label text-md-start">{{ __('Other Events') }}</label>
                    <div class="col-md-6">
                        <textarea id="other_events" class="form-control" name="other_events">{{ old('other_events', $record->other_events) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="notes" class="col-md-2 col-form-label text-md-start">{{ __('Notes') }}</label>
                    <div class="col-md-6">
                        <textarea id="notes" class="form-control" name="notes" rows="4">{{ old('notes', $record->notes) }}</textarea>
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
    <script>
        //create input fields to add workers and store the values of each field in an array
        function addWorkerField() {

            var container = document.getElementById('workers-container');
            var newFieldset = document.createElement('fieldset');

            newFieldset.innerHTML = `
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="w_first_name" class="col-form-label text-md-start">{{ __('Worker First Name') }}</label>
                        <input type="text" class="form-control" name="w_first_name[]" required autocomplete="given-name">
                    </div>
                    <div class="col-md-4">
                        <label for="w_surname" class="col-form-label text-md-start">{{ __('Worker Surname') }}</label>
                        <input type="text" class="form-control" name="w_surname[]" required autocomplete="family-name">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="start_time" class="col-form-label text-md-start">{{ __('Start Working Time') }}</label>
                        <input type="time" class="form-control" name="start_time[]" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_time" class="col-form-label text-md-start">{{ __('End Working Time') }}</label>
                        <input type="time" class="form-control" name="end_time[]" required>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-danger border-0" onclick="removeWorkerField(this)">Remove</button>`;

            container.appendChild(newFieldset);
        }

        // cancel the worker fieldset
        function removeWorkerField(button) {
            var fieldset = button.parentNode;
            var container = fieldset.parentNode;
            
            // Remove the fieldset from the container
            container.removeChild(fieldset);
        }

    </script>



@endsection