@extends('layouts.admin.app')

@section('title', 'Admin | Edit Category')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">
                            Edit Category <i class="fas fa-edit ml-1"></i>
                            <a class="float-left btn btn-sm btn-warning me-3 text-smallest"
                                href="{{ route('admin.categories.index') }}"><i class="fas fa-chevron-left"></i>
                                Back</a><br>
                        </h3>
                    </div>
                    <div class="card-body">
                        @include('layouts.includes.alert')
                        <form action="{{ route('admin.categories.update', $category) }}" method="post"
                            id="category_form">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Campus *</label>
                                <input class="form-control form-control-sm" type="text" name="name"
                                    value="{{ $category->name }}" required>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary float-right mt-2"
                                onclick="promptUpdate(event,'#category_form')">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script>
        $('#category_nav').addClass('active')
    </script>
@endsection
