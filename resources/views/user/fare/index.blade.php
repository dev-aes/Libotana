@extends('layouts.user.app')

@section('title', "$app_name | Fare Matrix")

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <caption>List of Tricycle Fare</caption>
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Km</th>
                                    <th>Regular Fare</th>
                                    <th>Discounted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tricycle_fares as $tricycle_fare)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $tricycle_fare->kilometer }} km</td>
                                        <td>₱{{ $tricycle_fare->fare }}</td>
                                        <td>₱{{ $tricycle_fare->discounted_fare }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Fare Matrix Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <caption>List of Jeepney Fare</caption>
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Km</th>
                                    <th>Regular Fare</th>
                                    <th>Discounted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jeepney_fares as $jeepney_fare)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $jeepney_fare->kilometer }} km</td>
                                        <td>₱{{ $jeepney_fare->fare }}</td>
                                        <td>₱{{ $jeepney_fare->discounted_fare }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Fare Matrix Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
