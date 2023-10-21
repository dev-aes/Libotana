@extends('layouts.user.app')

@section('title', "$app_name | $destination->title")


@section('content')

@section('bgc', 'bg-white')

{{-- CONTAINER --}}
<div class="container-fluid mt-3">
    @include('layouts.includes.alert')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.destinations.index') }}">
                    All Tourist Destination
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $destination->title }}
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body px-3 py-0">

                {{-- Start Carousel --}}
                <div id="other_featured_photos" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        {{-- display cars's images on carousel --}}

                        <div class="carousel-item active">

                            <a class="glightbox" href="{{ handleNullImage($destination->featured_photo) }}">
                                <img src="{{ handleNullImage($destination->featured_photo) }}" class="d-block mx-auto"
                                    width='400' alt="featured_photo">
                            </a>

                        </div>

                        @foreach ($destination->getMedia('other_featured_photos') as $img)
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
                <h3 class="font-weight-bold text-dark">{{ $destination->title }} <i
                        class="fas fa-map-pin ml-1 text-danger"></i>
                </h3>

                <div>
                    <small>
                        {{ $destination->history }}

                    </small>

                </div>
                <hr>
                <h3>Available Transport Vehicles</h3>
                <div class="row">
                    @forelse ($destination->vehicles as $vehicle)
                        <div class="col-6 col-md-4 px-2 d-flex align-self-stretch">
                            <div class="card w-100">
                                <div class="card-body px-0 py-0 text-center d-flex and flex-column">
                                    <img class="img-fluid" src="{{ handleNullImage($vehicle->featured_photo) }}"
                                        alt="featured photo">
                                </div>
                                <div class="card-footer border-0">
                                    <a class="h4 font-weight-normal" href="{{ route('user.vehicles.show', $vehicle) }}">
                                        {{ $vehicle->name }}
                                    </a>
                                    <br><br>
                                    <small>
                                        Routes: {{ $vehicle->routes }}
                                    </small>
                                    <br>
                                    <small>
                                        Travel Duration: {{ $vehicle->pivot->duration }} <i
                                            class="fas fa-clock ml-1"></i>
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

    {{-- Map --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gray text-white">

                    Google Map <i class="fas fa-map-marked-alt ml-1"></i>
                </div>
                <div class="card-body">
                    <div id="map">
                        {{-- Display Map --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End CONTAINER --}}
@endsection

@section('script')
<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap">
</script>
<script>
    let destination = {!! $destination !!};
    let lat = parseFloat(destination.latitude);
    let lng = parseFloat(destination.longitude);

    function initMap() {
        let map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat,
                lng
            },
            zoom: 17, // street view
        });

        addMarker({
            destination,
            position: {
                lat,
                lng
            },
            icon: '/img/marker/destination.png'
        }, map)

    }


    function addMarker(config, map) {
        // initialize marker
        const marker = new google.maps.Marker({
            position: config.position,
            animation: google.maps.Animation.BOUNCE,
            map,
            icon: config.icon ?? null,
        });

        let content;


        content = `<h3 class='font-weight-normal'>${config.destination.title} <i class='fas fa-map-pin text-danger ml-1'></i></h3>
                    <h4 class='font-weight-normal'>Direction: ${config.destination.address} </h4>
                  
            `;

        // <h4 class='font-weight-normal'>History: ${config.destination.history} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>


        if (config.destination !== undefined) {
            const infoWindow = new google.maps.InfoWindow({
                content: content,
            });

            marker.addListener("click", () => {
                infoWindow.open(marker.getMap(), marker);
            });
        }
    }

    window.initMap = initMap;
</script>
@endsection
