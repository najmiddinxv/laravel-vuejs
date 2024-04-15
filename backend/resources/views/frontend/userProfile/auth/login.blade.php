@extends('frontend.layouts.main')
@section('content')
    <div class="container">
        <div style="display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;">
            <div class="signin-form" style="width: 30%">
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

                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session('error') }}</p>
                @endif

                <form action="{{ route('userProfile.auth.login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                            placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me next time</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
