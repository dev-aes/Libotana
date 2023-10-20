@extends('layouts.admin.app')

@section('title', 'Admin | Manage user')

@section('content')

    {{-- CONTAINER --}}
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.includes.alert')
                <div class="row">
                    @forelse ($users as $user)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" style="position: relative;">
                                    <div class='dropdown' style="position: absolute;top:5%;right:0%;">
                                        <a class='btn btn-sm btn-icon-only text-light' href='#' role='button'
                                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <i class='fas fa-ellipsis-v'></i>
                                        </a>
                                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                            @if ($user->is_activated)
                                                {{-- deactivate user --}}
                                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                                    id="u_user_form-{{ $user->id }}">
                                                    @csrf @method('PUT')

                                                    <input type="hidden" name="status" value="deactivate">
                                                </form>
                                                <a class='dropdown-item' href="javascript:void(0)"
                                                    onclick="event.preventDefault();confirm('Do you want to Deactivate Account?','', 'Yes').then(res => res.isConfirmed ? $('#u_user_form-{{ $user->id }}').submit() : false)">Deactivate
                                                    Account</a>
                                            @else
                                                {{-- activate user --}}
                                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                                    id="u_user_form-{{ $user->id }}">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="activate">
                                                </form>
                                                <a class='dropdown-item' href="javascript:void(0)"
                                                    onclick="event.preventDefault();confirm('Do you want to Activate Account?','', 'Yes').then(res => res.isConfirmed ? $('#u_user_form-{{ $user->id }}').submit() : false)">Activate
                                                    Account</a>
                                            @endif

                                            <a href="javascript:void(0)" class="dropdown-item"
                                                onclick="promptDestroy(event,'#user_form-{{ $user->id }}')">
                                                Delete
                                            </a>
                                            <form class="float-right" action="{{ route('admin.users.destroy', $user) }}"
                                                method="post" id="user_form-{{ $user->id }}">
                                                @csrf @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Content --}}
                                    <div class="row">
                                        {{-- Logo --}}
                                        <div class="col-3">
                                            <img class="d-block mx-auto rounded-circle"
                                                src="{{ handleNullAvatar($user->avatar_thumbnail) }}" width="60"
                                                alt="{{ $user->name }}">
                                        </div>

                                        {{-- user Info --}}
                                        <div class="col-9">
                                            <h5 class="text-capitalize">Name: {{ $user->name }}</h5>
                                            <h5 class="text-capitalize">Registered:
                                                {{ formatDate($user->created_at) }}
                                            </h5>
                                            <p class="text-sm mt-2">
                                                <span class="badge bg-primary text-white">{{ $user->role->name }}</span>
                                                {!! isActivated($user->is_activated) !!}
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        $('#user_management_nav').addClass('active')
    </script>
@endsection
