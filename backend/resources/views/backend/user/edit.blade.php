@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Users</a></li>
                <li class="breadcrumb-item active">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>

    <x-alert-message-component></x-alert-message-component>

    <form class="g-3 needs-validation" action="{{ route('backend.user.update',['user' => $user->id]) }}" method="POST" novalidate enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="padding:20px">
                      <div class="form-group">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name, old('last_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name, old('last_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text" name="middle_name" class="form-control" id="middle_name" value="{{ $user->middle_name, old('middle_name') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="username" class="form-label">username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ $user->username, old('username') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label">Email name</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email, old('email') }}" required>
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
                            <img id="previewImage" src="{{ Storage::url($user->avatar['large'] ?? '-') }}" alt="User Avatar" style="max-width: 100%;">

                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="form-label">phone number</label>
                            <input type="tel" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number, old('phone_number') }}" required>
                            {{-- <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required> --}}
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">password</label>
                            <input type="password" name="password" class="form-control" id="password" >
                            <div class="valid-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">password_confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
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
