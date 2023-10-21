@extends('layouts.user.app')

@section('title', "$app_name | $vehicle->name")


@section('content')

@section('bgc', 'bg-white')

{{-- CONTAINER --}}
<div class="container-fluid mt-3">
    @include('layouts.includes.alert')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.vehicles.index') }}">
                    All Vehicles
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $vehicle->name }}
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">

                {{-- Start Carousel --}}
                <div id="other_featured_photos" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        {{-- display cars's images on carousel --}}

                        <div class="carousel-item active">

                            <a class="glightbox" href="{{ handleNullImage($vehicle->featured_photo) }}">
                                <img src="{{ handleNullImage($vehicle->featured_photo) }}" class="d-block mx-auto"
                                    width='400' alt="featured_photo">
                            </a>

                        </div>

                        @foreach ($vehicle->getMedia('other_featured_photos') as $img)
                            <div class="carousel-item">
                                <a class="glightbox" href="{{ handleNullImage($img->getUrl('card')) }}">
                                    <img src="{{ handleNullImage($img->getUrl('card')) }}" class="d-block mx-auto"
                                        width='400' alt="featured_photo">
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#other_featured_photos"
                        data-slide="prev">
                        <span class="fas fa-chevron-left text-dark" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#other_featured_photos"
                        data-slide="next">
                        <span class="fas fa-chevron-right text-dark" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
                {{-- End Carousel --}}
                <br>
                <h3 class="font-weight-bold text-primary">{{ $vehicle->name }} <i class="fas fa-car ml-1"></i>
                </h3>

                <div>
                    Routes: {{ $vehicle->routes }}

                </div>
                <hr>
                <h3>Traveled Tourist Destinations <i class="fas fa-map-marked-alt ml-1"></i></h3> <br>
                <div class="row">
                    @forelse ($vehicle->destinations as $destination)
                        <div class="col-6 col-md-4 px-2 d-flex align-self-stretch">
                            <div class="card w-100">
                                <div class="card-body px-0 py-0 text-center d-flex and flex-column">
                                    <img class="img-fluid" src="{{ handleNullImage($destination->featured_photo) }}"
                                        alt="featured photo">
                                </div>
                                <div class="card-footer border-0">
                                    <a href="{{ route('user.destinations.show', $destination) }}">
                                        <small>{{ $destination->title }} <i
                                                class="fas fa-map-pin ml-1 text-danger"></i></small>
                                    </a>
                                    <br><br>
                                    <small>
                                        Address: {{ $destination->address }}
                                    </small>
                                </div>
                            </div>
                        </div>

                    @empty

                        <div class="col-12 px-2">
                            <div class="card card-body px-0 py-2 text-center">
                                Record Not Found
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End CONTAINER --}}
@endsection
