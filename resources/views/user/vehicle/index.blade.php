@extends('layouts.user.app')

@section('title', "$app_name | All Public Vehicles")

@section('content')

    {{-- CONTAINER --}}
    <div class="container pt-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4 class="mb-3 font-weight-normal">
                    <div class="dropdown ">
                        <a class="text-muted dropdown-toggle text-small" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" data-display="static" aria-expanded="false">
                            All Filter
                        </a>

                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow scrollable-dropdown"
                            aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item" href="{{ route('user.vehicles.index') }}">
                                All Vehicles
                            </a>

                            <div class="dropdown-divider"></div>

                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Categories</h6>
                            </div>

                            @foreach ($categories as $id => $category)
                                <a class="dropdown-item @if (request('category') == $id) text-primary @endif"
                                    href="{{ route('user.vehicles.index') }}?category={{ $id }}">
                                    {{ $category }}
                                </a>
                            @endforeach

                        </div>
                    </div>

                </h4>

                {{-- Start ROW --}}
                <div class="row">
                    @forelse ($vehicles as $vehicle)
                        <div class="col-6 col-md-4 col-lg-2 d-flex align-self-stretch px-1">
                            <div class="card w-100 card-shadow-none hoverable">
                                <img class="card-img-top" src="{{ handleNullImage($vehicle->featured_photo) }}"
                                    width="120" alt="pet">
                                <div class="card-body d-flex flex-column text-small">
                                    <a class="card-text mb-2 text-dark font-weight-bold"
                                        href="{{ route('user.vehicles.show', $vehicle) }}">
                                        {{ $vehicle->name }}
                                    </a>
                                    <span>
                                        <small>
                                            Routes: {{ $vehicle->routes }}
                                        </small>
                                    </span><br>
                                </div>
                            </div>
                        </div>


                    @empty
                        <div>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/nodata.svg') }}"
                                alt="record not found">
                        </div>
                    @endforelse


                </div>

                <div class="d-flex justify-content-center">
                    {{ $vehicles->isNotEmpty() ? $vehicles->links() : '' }}
                </div>

                {{-- End ROW --}}
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
