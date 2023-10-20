@extends('layouts.admin.app')

@section('title', 'Admin | Manage Category')

@section('content')

    {{-- CONTAINER --}}
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="mb-3">
                    List of Category
                    <a class="float-right btn btn-sm btn-warning me-3 text-smallest"
                        href="{{ route('admin.categories.create') }}">Create Category +</a><br>
                </h3>
                @include('layouts.includes.alert')
                <div class="row">
                    @forelse ($categories as $category)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="position: relative;">
                                    <div class='dropdown' style="position: absolute;top:5%;right:0%;">
                                        <a class='btn btn-sm btn-icon-only text-light' href='#' role='button'
                                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <i class='fas fa-ellipsis-v'></i>
                                        </a>
                                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                            <a class='dropdown-item'
                                                href="{{ route('admin.categories.show', $category) }}">View</a>

                                            <a class='dropdown-item'
                                                href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                                            <a href="javascript:void(0)" class="dropdown-item"
                                                onclick="promptDestroy(event,'#category_form-{{ $category->id }}')">
                                                Delete
                                            </a>
                                            <form class="float-right"
                                                action="{{ route('admin.categories.destroy', $category) }}" method="post"
                                                id="category_form-{{ $category->id }}">
                                                @csrf @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Content --}}
                                    <div class="row">
                                        {{-- Logo --}}
                                        <div class="col-3">
                                            <img class="d-block mx-auto rounded-circle"
                                                src="{{ asset('img/logo/logo2.png') }}" width="60"
                                                alt="{{ $category->name }}">
                                        </div>

                                        {{-- category Info --}}
                                        <div class="col-9">
                                            <a class="text-smaller"
                                                href="{{ route('admin.categories.show', $category) }}">
                                                {{ $category->name }}
                                            </a>
                                            <p class="text-sm mt-2">
                                                <span class="badge bg-primary text-white">category</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <figure>
                            <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" alt="">
                            <figcaption>
                                <p class="text-center">Record Not Found</p>
                            </figcaption>
                        </figure>
                    @endforelse

                    <div class="d-flex ml-auto">
                        {{ $categories->links() }}
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
