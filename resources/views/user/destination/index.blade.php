@extends('layouts.user.app')

@section('title', "$app_name | Tourist Destinations")

@section('content')


    <!-- Modal -->
    <div class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="nearest_destination" aria-hidden="true" id="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tourist Destinations <i class="fas fa-map-pin ml-1 text-danger"></i></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/destination/destination.svg') }}"
                        alt="">
                    Below are the top three nearest tourist spot based
                    on your current location.<br><br>

                    <ul class="list-group" id="display_nearest_destinations">
                        {{-- Display Nearest Tourist Destination --}}
                    </ul>
                    <br>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTAINER --}}
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" id="map-wrapper">

            <div id="map">
                {{-- Map --}}
            </div>

            <div class="btn-group mt-auto">
                <a href="javascript:void(0)" class="btn-dark text-center p-2" id="distance-info">Distance: N/A |
                    Duration:
                    N/A</a>
                <a class="btn btn-primary p-2" href="javascript:void(0)" onclick="getNearestDestination()">Toggle
                    Nearest Tourist Destination <i class="fas fa-map-marker-alt ml-1 text-danger"></i></a>
            </div>


            <div id="user-location">
                <!-- User's live location will be displayed here -->
            </div>

            <form action="{{ route('user.destinations.index') }}" method="GET" id="destination">
                <div class="input-group">
                    <select class="selectpicker show-tick" data-style='btn-white text-primary' data-live-search="true"
                        data-width='300px' name="destination_id" onchange="$('#destination').submit()">

                        @if ($searches->isNotEmpty())
                            <optgroup label="Search History">
                                @foreach ($searches as $search)
                                    <option data-icon='fas fa-map-marker-alt'
                                        data-tokens="{{ $search->destination->title }}"
                                        value="{{ $search->destination_id }}">
                                        {{ $search->destination->title }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif

                        <optgroup label="destinations">
                            @if ($searches->isEmpty())
                                <option value="">Search Destination....</option>
                            @endif
                            @foreach ($destinations as $destination)
                                <option data-icon='fas fa-map-marker-alt' data-tokens="{{ $destination->title }}"
                                    value="{{ $destination->id }}">
                                    {{ $destination->title }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    <div class="input-group-append">
                        <a class="btn btn-primary text-white" href=""><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>
            <div id="directionsPanel" style="width:100%;height:100%"></div>

        </div>
    </div>
    {{-- End CONTAINER --}}
@endsection
@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap"
        defer></script>
    <script>
        $(() => {
            $('#destination').selectpicker()
        })
    </script>

    @if ($selected_destination)
        <script>
            let markers = []
            let map,
                infoWindow,
                directionsService,
                directionsRenderer;

            let lat = 13.399041;
            let lng = 123.308694;

            let destination = {!! $selected_destination !!}
            let vehicles = destination.vehicles;


            function initMap() {

                let route_index = route('user.destinations.index');

                infoWindow = new google.maps.InfoWindow();
                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer({
                    copyrights: "Libotana",
                    panel: document.getElementById('directionsPanel'),
                    suppressMarkers: true
                });
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 19, // street view
                    gestureHandling: 'greedy',
                });

                directionsRenderer.setMap(map);

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {

                            // live location
                            const current_location = {
                                lat: parseFloat(position.coords.latitude),
                                lng: parseFloat(position.coords.longitude),
                            };


                            // temporary location
                            // const current_location = {
                            //     lat: 13.399041,
                            //     lng: 123.308694,
                            // };


                            const payload = {
                                origin: {
                                    lat: current_location.lat,
                                    lng: current_location.lng,
                                },
                                destination: {
                                    lat: parseFloat(destination.latitude),
                                    lng: parseFloat(destination.longitude),
                                },
                                provideRouteAlternatives: false,
                                travelMode: 'WALKING',
                                unitSystem: google.maps.UnitSystem.METRIC
                            }

                            directionsService.route(payload, function(result, status) {
                                if (status == 'OK') {

                                    directionsRenderer.setDirections(result);

                                    const distance = result.routes[0].legs[0].distance.text;
                                    const duration = result.routes[0].legs[0].duration.text;
                                    document.getElementById('distance-info').innerHTML =
                                        `Distance: ${distance}, Duration: ${duration}`;

                                    const route_show = route('user.destinations.show', destination.id)
                                    let output;


                                    output =
                                        `<h3 class='font-weight-normal'>${destination.title} <i class='fas fa-map-pin text-danger ml-1'></i></h3>
                                        
                                        <h4 class='font-weight-normal'>Address: ${destination.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                        `;

                                    output += `<h5> Available Transport Vehicles</h5>
                                        <ul class='list-group'>`;

                                    if (vehicles.length > 0) {
                                        vehicles.forEach(vehicle => {
                                            output +=
                                                `<li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class="badge badge-primary badge-pill">
                                                            ${vehicle.name} - ${vehicle.category.name}
                                            </span>
                                        </li>`
                                        });

                                    } else {
                                        output +=
                                            `<li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class="badge badge-primary badge-pill">
                                                      N/A
                                            </span>
                                        </li>`
                                    }

                                    output += `</ul> <br>`

                                    output += `
                                                
                                                `;


                                    output += `<br>
                    
                                        <div class='d-flex'>
                                            <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a> 
                                        
                                            <a class='btn btn-sm btn-outline-primary' href="https://www.google.com/maps?q=${destination.latitude},${destination.longitude}" target="_blank">Open in Google Maps
                                            </a>    
                                        </div>
                                        <br>
                                    `;

                                    const destinations = [
                                        // origin    
                                        {
                                            position: {
                                                lat: payload.origin.lat,
                                                lng: payload.origin.lng,
                                            },
                                            icon: '/img/marker/my-marker.png',
                                            name: "I'm here!"
                                        },
                                        // destination
                                        {
                                            position: {
                                                lat: payload.destination.lat,
                                                lng: payload.destination.lng,
                                            },
                                            icon: '/img/marker/destination.png',
                                            name: output
                                        }
                                    ]

                                    markers.forEach(marker => marker.setMap(null))
                                    addMarkers(destinations, map)
                                }
                            });
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            window.initMap = initMap;
        </script>
    @else
        <script>
            let lat = 13.399041;
            let lng = 123.308694;
            let markers = []; //  Array to store the markers of nearby gas stations
            let map,
                infoWindow,
                directionsService,
                directionsRenderer;

            let destinations = @json($destinations);

            function initMap() {

                let route_index = route('user.destinations.index')

                infoWindow = new google.maps.InfoWindow();
                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer({
                    copyrights: "iGas",
                    panel: document.getElementById('directionsPanel'),
                    suppressMarkers: true
                });

                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 15, // street view
                    gestureHandling: 'greedy',
                });

                directionsRenderer.setMap(map);

                let refactored_destinations = [];


                destinations.forEach((destination) => {

                    let route_show = route('user.destinations.show', destination.id)
                    let output;

                    let vehicles = destination.vehicles;


                    output =
                        `<h3 class='font-weight-normal'>${destination.title} <i class='fas fa-map-pin text-danger ml-1'></i></h3>
                        <h4 class='font-weight-normal'>Address: ${destination.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                        `;

                    output += `<h5> Available Transport Vehicles</h5>
                                        <ul class='list-group'>`;

                    if (vehicles.length > 0) {
                        vehicles.forEach(vehicle => {
                            output +=
                                `<li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class="badge badge-primary badge-pill">
                                                            ${vehicle.name} - ${vehicle.category.name}
                                            </span>
                                        </li>`
                        });

                    } else {
                        output +=
                            `<li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class="badge badge-primary badge-pill">
                                                      N/A
                                            </span>
                                        </li>`
                    }


                    output += `</ul> <br>`

                    output += ` `;

                    output += `<br>
                    
                        <div class='d-flex'>
                            <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a> <br>
                            <a class='btn btn-sm btn-outline-primary' href='${route_index}?destination_id=${destination.id}'> 
                                <i class='fas fa-directions mr-1'></i>
                                    Direction
                            </a>

                            <a class='btn btn-sm btn-outline-primary' href="https://www.google.com/maps?q=${destination.latitude},${destination.longitude}" target="_blank">Open in Google Maps
                            </a>   
                            </div>
                    `;


                    refactored_destinations.push({
                        position: {
                            lat: parseFloat(destination.latitude),
                            lng: parseFloat(destination.longitude),
                        },
                        icon: '/img/marker/destination.png',
                        name: output
                    });

                });

                addMarkers(refactored_destinations, map);


                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {

                            // live location
                            const current_location = {
                                lat: parseFloat(position.coords.latitude),
                                lng: parseFloat(position.coords.longitude),
                            };


                            // temporary location
                            // const current_location = {
                            //     lat: 13.399041,
                            //     lng: 123.308694,
                            // };

                            map.setCenter(current_location); // Center the map on the user's current location.

                            const myLocation = new google.maps.Marker({
                                position: current_location, // temp location
                                animation: google.maps.Animation.DROP,
                                map, // display market to this map,
                                icon: '/img/marker/my-marker.png',
                            }); // display my location

                            myLocation.addListener('click', () => {
                                infoWindow.setContent('You are here')
                                infoWindow.open(map, myLocation)
                            })

                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

            }
        </script>
    @endif

    <script>
        function updateUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const current_location = {
                            lat: parseFloat(position.coords.latitude),
                            lng: parseFloat(position.coords.longitude),
                        };

                        const userLocationElement = document.getElementById('user-location');
                        userLocationElement.textContent =
                            `Current Location: Lat ${current_location.lat}, Lng ${current_location.lng}`;

                        // You can also update the map or perform any other actions based on the user's live location here.
                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        // Call updateUserLocation every 30 seconds (adjust the interval as needed)

        // setInterval(() => {
        //     updateUserLocation();

        //     log('loaded');
        // }, 10000);


        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }

        function addMarkers(destinations, map) {

            destinations.forEach(destination => {

                // initialize marker
                let marker = new google.maps.Marker({
                    position: destination.position,
                    animation: google.maps.Animation.BOUNCE,
                    map: map, // display market to this map,
                    icon: destination.icon ?? '/img/marker/destination.png',
                });

                google.maps.event.addListener(marker, "click", function(e) {
                    infoWindow.setContent(`${destination.name}`);
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            });
        }

        function getNearestDestination() {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {


                        axios.post(route('user.nearest_destinations.get'), {
                                latitude: parseFloat(position.coords.latitude),
                                longitude: parseFloat(position.coords.longitude),
                            })
                            .then(res => {
                                let output = ``;

                                let nearest_destinations = Object.values(res.data);


                                // Sort the nearest_destinations array by distance
                                nearest_destinations.sort((a, b) => a.distance - b.distance);

                                nearest_destinations.forEach((nearest_destination) => {

                                    const {
                                        id,
                                        title,
                                        distance
                                    } = nearest_destination; // Destructure the object properties

                                    let route_show = route('user.destinations.show',
                                        id)
                                    output += `<a href="${route_show}" class="list-group-item list-group-item-action h5 text-primary">
                                                    ${title} |
                                                    ${number_format(distance)} km away
                                                </a>`;
                                });

                                $('#display_nearest_destinations').html(output);
                                $('#modal').modal('show');

                            })
                            .catch(e => log(e))


                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    </script>


@endsection
