@extends('layouts.admin.app')

@section('title', "$app_name | Manage Vehicle")

@section('content')

    {{-- CONTAINER --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.destinations.show', $destination) }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Manage Assigned Vehicle <i class="fas fa-edit ml-1"></i></span>
                        </h2>
                        @include('layouts.includes.alert')

                        <br>
                        <form action="{{ route('admin.destinations.vehicles.store', $destination) }}" method="post"
                            id="destination_form">
                            @csrf


                            <fieldset>
                                <legend>
                                    <h3 class="text-primary">
                                        Add Vehicle <i class="fas fa-clipboard-list ml-1"></i>
                                    </h3>
                                </legend>
                                <div id="vehicle_input">
                                    <div class="row py-2 align-items-center">
                                        <div class="col-6">
                                            <select class="form-control" name="vehicle[]">
                                                <option value="">Select Vehicle</option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}">
                                                        {{ $vehicle->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <input class="form-control" type="text" name="duration[]"
                                                placeholder="Travel Duration (Eg. 30min)" required>
                                        </div>
                                        <div class="col-2">
                                            <a href="javascript:void(0)" role="button" onclick="addVehicleInputField()"> <i
                                                    class="fas fa-plus-circle text-success fa-lg"></i></a>
                                        </div>
                                    </div>

                                    @foreach ($destination->vehicles as $current_vehicle)
                                        <div class="row py-2 align-items-center" id="row_input-{{ $current_vehicle->id }}">
                                            <div class="col-6">
                                                <select class="form-control" name="vehicle[]">
                                                    <option value="">Select Vehicle</option>
                                                    @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}"
                                                            @if ($current_vehicle->id == $vehicle->id) selected @endif>
                                                            {{ $vehicle->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-4">
                                                <input class="form-control" type="text" name="duration[]"
                                                    placeholder="Travel Duration (Eg. 30min)"
                                                    value="{{ $current_vehicle->pivot->duration }}" required>
                                            </div>
                                            <div class="col-2">
                                                <a href="javascript:void(0)" role="button"
                                                    onclick="removeVehicleInputField({{ $current_vehicle->id }})">
                                                    <i class="fas fa-minus-circle text-danger fa-lg"></i></a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </fieldset>

                            <div class="form-group ">
                                <button type="button" class="btn btn-primary mt-3"
                                    onclick="promptUpdate(event, '#destination_form')">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}
@endsection

@section('script')
    <script>
        $(() => {
            $.fn.selectpicker.Constructor.BootstrapVersion = '4';

            $('#resident').selectpicker()

        })

        /**
         * add input field
         */
        function addVehicleInputField() {
            let vehicles = @json($vehicles);
            let id = Math.floor((Math.random() * 100) + 1);
            let output = `
        
        <div class="row py-2 align-items-center" id='row_input-${id}'>
                        <div class="col-6">
                            <select class="form-control" name="vehicle[]">
                                 <option value="">Select Vehicle</option>
                                 ${displayVehicleInputField(vehicles)}
                           </select>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text"  name="duration[]" placeholder='Travel Duration (Eg. 30min)' required>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" role="button" onclick="removeVehicleInputField(${id})"> <i class="fas fa-minus-circle text-danger fa-lg"></i></a>
                        </div>
         </div>
        
        `
            $('#vehicle_input').append(output)
        }

        /**
         * display dynamic option field to the Vehicle select input
         */
        function displayVehicleInputField(vehicles) {
            let output = ` `;
            if (vehicles.length > 0) {
                vehicles.forEach(vehicle => {
                    output += `<option value='${vehicle.id}'>${vehicle.name}</option>`
                })

                return output;
            }
        }

        /**
         * remove input field
         */
        function removeVehicleInputField(id) {
            $('#row_input-' + id).remove()
        }
    </script>
@endsection
