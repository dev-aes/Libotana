@extends('layouts.admin.app')

@section('title', 'Admin | Manage Destination')

@section('styles')
    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('admin.destinations.create') }}">Create
                            Destination +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover destination_dt">
                                <caption>List of Tourist Destination <i class="fas fa-map-marker-alt ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Featured Photo</th>
                                        <th>Title</th>
                                        <th>History</th>
                                        <th>Lat</th>
                                        <th>Lng</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display destinations --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
