@extends('layouts.admin.app')

@section('title', 'Admin | Create Destination')

@section('content')

    {{-- CONTAINER --}}
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.destinations.index') }}">
                        All Destinations
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Create Destination
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('admin.destinations.store') }}" method="post"
                                    enctype="multipart/form-data" id="destination_form">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label">Title *</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Ex. Holy Rosary Parish Church" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">History *</label>
                                        <textarea class="form-control" name="history" rows="5"
                                            placeholder="Tell us about the history of this tourist destination."></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Address *</label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Complete Address" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Latitude *</label>
                                        <input class="form-control" type="number" step="0.00000000001" name="latitude"
                                            required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Longitude *</label>
                                        <input class="form-control" type="number" step="0.00000000001" name="longitude"
                                            required>
                                    </div>

                                    <div>
                                        <input type="file" class="featured_photo" name="featured_photo">
                                    </div>

                                    <div>
                                        <input type="file" class="other_featured_photos" name="image[]" multiple>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary"
                                            onclick="promptStore(event, '#destination_form')">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        initiateFilePond('.featured_photo', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Select or <span class="filepond--label-action"> Browse Featured Photo *</span>')


        initiateFilePond('.other_featured_photos', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Select or <span class="filepond--label-action"> Browse Other Photos</span>')
    </script>
@endsection
