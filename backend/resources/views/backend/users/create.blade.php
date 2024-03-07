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

    <x-alert-message-component></x-alert-message-component>

    <form class="g-3 needs-validation" action="{{ route('backend.users.store') }}" method="POST" novalidate enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="padding:20px">
                      <div class="form-group">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text" name="middle_name" class="form-control" id="middle_name" value="{{ old('middle_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label">Email name</label>
                        <input type="email" name="email" class="form-control" id="email"  value="{{ old('email') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="padding:20px">
                        <div class="form-group">
                            <label for="userAvatar" class="col-form-label">user avatar</label>
                            <input type="file" class="form-control" name="userAvatar" id="userAvatar" accept=".jpg,.jpeg,.png">
                            <img id="previewImage" src="#" alt="Preview Image" style="max-width: 100%; display: none;">

                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="form-label">phone number</label>
                            <input type="tel" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}" required>
                            {{-- <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required> --}}
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">password</label>
                            <input type="password" name="password" class="form-control" id="password" required >
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">password_confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            <div class="valid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <button class="btn btn-success" type="submit">{{ __('lang.save') }}</button>
            </div>
        </div>

    </form>

@endsection
@section('scripts')
<script>
    $(document).ready(function (e) {

        $('#userAvatar').on('change',function(){
            let reader = new FileReader();
            reader.onload = (e) => {
            $('#previewImage').attr('src', e.target.result);
            $('#previewImage').css({'display':'block'});
        }
        reader.readAsDataURL(this.files[0]);

    });

    });
</script>
@endsection
