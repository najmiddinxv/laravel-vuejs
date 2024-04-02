@extends('frontend.layouts.main')
@section('content')
    <div class="row justify-content-center align-items-center" style="height: 100vh">

        <div class="col-lg-4">
            <div class="signup-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Sign Up Form</h6>
                    <p class="text-sm mb-25">
                    </p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session('error') }}</p>
                    @endif

                    <form action="{{route('userProfile.auth.register')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Username</label>
                                    <input type="text" name="username" placeholder="username" />
{{--                                    @error('email')--}}
{{--                                    <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                    @enderror--}}
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Password confirm</label>
                                    <input type="password" name="password_confirmation" placeholder="Password" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox-not-robot" />
                                    <label class="form-check-label" for="checkbox-not-robot">
                                        I'm not robot</label>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center">
                                        Sign Up
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <div class="singup-option pt-40">
                        <p class="text-sm text-medium text-center text-gray">
                            Easy Sign Up With
                        </p>
                        <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                            <button class="main-btn primary-btn-outline m-2">
                                <i class="lni lni-facebook-fill mr-10"></i>
                                Facebook
                            </button>
                            <button class="main-btn danger-btn-outline m-2">
                                <i class="lni lni-google mr-10"></i>
                                Google
                            </button>
                        </div>
                        <p class="text-sm text-medium text-dark text-center">
                            Already have an account? <a href="{{route('userProfile.auth.login')}}">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
