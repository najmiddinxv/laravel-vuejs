@extends('backend.layouts.main')
@section('title')
    {{ __('lang.create') }}
@endsection

@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Users</a></li>
                <li class="breadcrumb-item active">user yaratish</li>
            </ol>
        </nav>
    </div>



    <form class="g-3 needs-validation" action="{{ route('backend.user.store') }}" method="POST" novalidate >
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="padding:20px">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" value="John" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom05" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="padding:20px">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" value="Doe" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <button class="btn btn-success" type="submit">Submit form</button>
            </div>
        </div>

    </form>

@endsection
