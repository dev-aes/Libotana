@extends('layouts.admin.app')

@section('title', 'Admin | Edit Vehicle')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.vehicles.index') }}">
                        All Vehicle
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit {{ $vehicle->name }}
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="post"
                                    enctype="multipart/form-data" id="vehicle_form">
                                    @csrf @method('PUT')

                                    <div class="form-group mb-2">
                                        <label class="form-label">Category *</label>
                                        <select class="form-control" name="category_id" required>
                                            <option value=""></option>
                                            @foreach ($categories as $id => $category)
                                                <option value="{{ $id }}"
                                                    @if ($vehicle->category_id == $id) selected @endif>
                                                    {{ $category }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label class="form-label">Model *</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ex. Jeep Name or Tricycle Name" value="{{ $vehicle->name }}"
                                            required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Routes *</label>
                                        <input type="text" class="form-control" name="routes"
                                            placeholder="Ex. Sto. domingo - Lapieta - Pulungbulu - Holy Angel - Nepo Mart"
                                            value="{{ $vehicle->routes }}" required>
                                    </div>

                                    <div>
                                        <input type="file" class="featured_photo" name="featured_photo">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="promptUpdate(event, '#vehicle_form', 'Do you want to Update?', 'Note: If you upload a new set of images it will overwrite the existing one.', 'Yes')">Save</button>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/crud/default.svg') }}" alt="vehicle">
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
    </script>
@endsection
