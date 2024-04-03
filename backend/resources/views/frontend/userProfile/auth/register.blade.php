@extends('frontend.layouts.main')
@section('content')



    <div class="container">
        <div style="display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;">
            <div class="signup-form" style="width: 30%">
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

                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session('error') }}</p>
                @endif

                <form action="{{ route('userProfile.auth.register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                        {{--                                    @error('email') --}}
                        {{--                                    <div class="alert alert-danger">{{ $message }}</div> --}}
                        {{--                                    @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>
                    {{-- <div class="col-12">
                                <div class="input-style-1">
                                    <label>Password confirm</label>
                                    <input type="password" name="password_confirmation" placeholder="Password" />
                                </div>
                            </div> --}}
                        <div class="form-check checkbox-style mb-30">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox-not-robot" />
                            <label class="form-check-label" for="checkbox-not-robot">
                                I'm not robot</label>
                        </div>
                    <div class="button-group d-flex justify-content-center flex-wrap">
                        <button class="btn btn-primary">
                            Sign Up
                        </button>
                    </div>
                </form>
                <div class="singup-option pt-40">
                    <p class="text-sm text-medium text-center text-gray">
                        Easy Sign Up With
                    </p>
                    <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                        <button class="btn btn-success">
                            <i class="lni lni-facebook-fill mr-10"></i>
                            Facebook
                        </button>
                        <button class="btn btn-success">
                            <i class="lni lni-google mr-10"></i>
                            Google
                        </button>
                    </div>
                    <p class="text-sm text-medium text-dark text-center">
                        Already have an account? <a href="{{ route('userProfile.auth.login') }}">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
