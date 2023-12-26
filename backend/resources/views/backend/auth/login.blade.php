@extends('backend.layouts.auth')
@section('content')


<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        {{-- <div class="d-flex justify-content-center py-4">
          <a href="index.html" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">LOGO</span>
          </a>
        </div>
         --}}
        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
              {{-- <p class="text-center small">Enter your username & password to login</p> --}}

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
            </div>

            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('backend.auth.login') }}">
                @csrf
                @method('POST')
                <div class="col-12">
                <label for="email" class="form-label">email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" name="email" class="form-control" id="email" required>
                  <div class="invalid-feedback">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="yourPassword" required>
                <div class="invalid-feedback">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror   
                </div>
              </div>

              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
              </div>
              {{-- <div class="col-12">
                <p class="small mb-0">Don't have account? <a href="#">Create an account</a></p>
              </div> --}}
            </form>

          </div>
        </div>

        {{-- <div class="credits">
          info <a href="#">info</a>
        </div> --}}

      </div>
    </div>
  </div>

@endsection
