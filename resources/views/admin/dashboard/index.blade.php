@extends('layouts.admin.app')

@section('content')
    <!-- Header -->
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row py-3">
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_active_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Inactive User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_inactive_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Transport Vehicle</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_vehicle }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-car"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Tourist Destination</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_destination }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6">

        {{-- Row 1 --}}
        <div class="row">
            <div class="col-12 col-md-12 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Total Vehicle By Category</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart -->
                        <div>
                            <canvas id="chart_total_vehicles_by_category"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="row">
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Monthly User</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart -->
                        <div>
                            <canvas id="monthly_users"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Recent Tourist</h6>
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-sm btn-white" href="{{ route('admin.users.index') }}">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        {{-- <th>Role</th> --}}
                                        <th>Registered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            {{-- <td>{{ $user->role->name }}</td> --}}
                                            <td>{{ formatDate($user->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>

                    <div class="d-flex mx-auto">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 3 --}}
        <div class="row">
            <div class="col-12 col-md-9 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Recent Destinations</h6>
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-sm btn-white" href="{{ route('admin.destinations.index') }}">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Featured Photo</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($destinations as $destination)
                                        <tr>
                                            <td>

                                                <img class="img-fluid" width="100"
                                                    src="{{ handleNullImage($destination->featured_photo) }}"
                                                    alt="featured photo">
                                            </td>
                                            <td>{{ $destination->title }}</td>

                                            <td>{{ formatDate($destination->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>

                    <div class="d-flex mx-auto">
                        {{ $destinations->links() }}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-dark font-weight-normal text-primary">Activity Logs</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.activity_logs.index') }}" class="btn btn-sm btn-primary">View
                                    All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        @forelse ($activities as $al)
                            @php
                                $exploaded = explode('-', $al->description);
                            @endphp
                            <div class='border-left border-primary'>
                                <p class="m-0 pl-2 text-small">{{ $exploaded[0] }} - <span class='txt-lightblue'>
                                        {{ $exploaded[1] }} </span> </p>
                                <p class='pl-2 text-small'> {{ $al->created_at->diffForHumans() }} </p>
                            </div>
                            <br>
                        @empty
                            <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" alt="nodata">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
@endsection

@section('script')
    <script>
        const bgc = [
            '#11cdef',
            '#5603ad',
            '#212529',
            '#2c3e50',
            '#ecf0f1',
            '#FFDE59',
            '#95a5a6',
        ];

        const categories = @json($chart_total_vehicles_by_category[0]);
        const total_vehicles = @json($chart_total_vehicles_by_category[1]);

        const chart_total_vehicles_by_category = document.getElementById('chart_total_vehicles_by_category');
        const CHART_A = new Chart(chart_total_vehicles_by_category, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: categories,
                datasets: [{
                    label: 'Total Transport Vehicles',
                    data: total_vehicles,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Transport Vehicles'
                }
            }
        });


        const months = @json($chart_monthly_users[0]);
        const total_user = @json($chart_monthly_users[1]);

        const monthly_users = document.getElementById('monthly_users');
        const CHART_B = new Chart(monthly_users, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: months,
                datasets: [{
                    label: 'Total User',
                    data: total_user,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Monthly User'
                }
            }
        });


        $('#dashboard_nav').addClass('active')
    </script>
@endsection
