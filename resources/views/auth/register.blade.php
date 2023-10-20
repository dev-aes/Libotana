@extends('layouts.main.app')

@section('title', "$app_name | Create an Account")

@section('content')
    <!-- Page content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 px-3 mb-5"><br>

                {{-- User Form --}}
                <fieldset>
                    <legend>
                        <h4 class="text-white"> <a class="text-white font-weight-bold" href="{{ route('auth.login') }}"><i
                                    class="fas fa-arrow-left"></i></a> <span class="ml-2">Register</span></h4>
                    </legend>

                    <div class="alert alert-info alert-dismissible fade show p-3 text-white" role="alert">
                        Join {{ config('app.name') }} now! Fill out the registration form to create your account and start
                        exploring nice destinations effortlessly.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @include('layouts.includes.alert')

                    <form action="{{ route('auth.attemptRegister') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input class="form-control" type="text" name="name" placeholder="Complete Name"
                                    autocomplete="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                </div>
                                <select class="form-control" name="gender">
                                    <option value="">Gender *</option>
                                    <option value="male" @if (old('gender') == 'male') selected @endif>Male</option>
                                    <option value="female" @if (old('gender') == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                                </div>
                                <input class="form-control" type="text" name="address" placeholder="Complete Address *"
                                    autocomplete="address-level1" value="{{ old('address') }}" required>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input class="form-control" type="number" min="0" name="contact"
                                    placeholder="Contact Ex. 09659312001 *" autocomplete="tel-local"
                                    value="{{ old('contact') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" type="email" name="email" placeholder="Email *"
                                    autocomplete="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password" placeholder="Password *"
                                    autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Re-type Password" autocomplete="new-password" required>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-info form-control">Register</button>
                        </div>
                        <br>
                        <div class="text-sm text-white text-center">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" style="text-decoration: underline; color: #fff">Login</a>
                        </div>
                    </form>
                </fieldset>
                {{-- End User Form --}}


            </div>
        </div>
    </div>
@endsection
