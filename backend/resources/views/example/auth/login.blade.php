@extends('layouts.auth')

@section('content')
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="{{ route('login.store') }}">
                    @csrf
                    @method('POST')

                    <h1 class="h3 mb-3 fw-normal">Login</h1>

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required="required" autofocus>
                        <label for="floatingName">Email</label>

                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                        <label for="floatingPassword">Password</label>
                      
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

                </form>
            </div>
        </div>
   </div>
@endsection
