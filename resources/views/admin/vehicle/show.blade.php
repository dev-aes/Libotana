@extends('layouts.admin.app')

@section('title', "$app_name | $vehicle->name")


@section('content')

@section('bgc', 'bg-white')

{{-- CONTAINER --}}
<div class="container-fluid mt-3">
    @include('layouts.includes.alert')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">

                <div class="border-0 d-flex justify-content-between">
                    <a href="{{ route('admin.vehicles.index') }}">
                        <i class="fas fa-chevron-left fa-lg"></i>
                    </a>
                    <div>
                        <i class="far fa-heart fa-lg mr-1"></i>
                        <i class="fas fa-share-alt fa-lg"></i>
                    </div>
                </div>
                <br>


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
                    {{ $vehicle->routes }}

                </div>

                <br>
                <h3>Destinations</h3>
                <div class="row">
                    @forelse ($vehicle->destinations as $destination)
                        <div class="col-4 px-2">
                            <div class="card card-body px-0 py-2 text-center">
                                <h5 class="text-muted">Destination</h5>
                                <h4>{{ $destination->title }}</h4>
                            </div>
                        </div>

                    @empty

                        <div class="col-4 px-2">
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
