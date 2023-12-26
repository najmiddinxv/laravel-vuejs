@extends('frontend.layouts.userProfileAuth')
@section('content')
    <div class="row justify-content-center align-items-center" style="height: 100vh">

        <div class="col-lg-4">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Sign In Form</h6>
                    <p class="text-sm mb-25"></p>
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
                    <form action="{{route('userProfile.auth.login')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
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
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" value="" name="remember" id="checkbox-remember" />
                                    <label class="form-check-label" for="checkbox-remember">
                                        Remember me next time</label>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="#" class="hover-underline">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <div class="singin-option pt-40">
                        <p class="text-sm text-medium text-center text-gray">
                            Easy Sign In With
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
                            Don’t have any account yet?
                            <a href="{{route('userProfile.auth.register')}}">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
