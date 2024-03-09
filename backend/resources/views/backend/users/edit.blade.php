@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            {{-- @dd($user) --}}
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">{{ $user->last_name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>

    {{-- <x-alert-message-component></x-alert-message-component> --}}

    <form class="g-3 needs-validation" action="{{ route('backend.users.update',['id' => $user->id]) }}" method="POST" novalidate enctype="multipart/form-data">
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
                        <label for="email" class="form-label">Email name</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email, old('email') }}" required>
                        <div class="valid-feedback">
                        </div>
                      </div>

                      <div class="border border-danger p-2 mt-4">

                        <div class="form-group mt-2">
                            <select name="user_type" id="user_type" class="user_type  form-control" required>
                                <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }}>Admin (Backend qismiga
                                    ruxsat)</option>
                                <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>User (Faqat Frontend
                                    qismiga ruxsat)</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <select name="is_active" id="is_active" class="select2_is_active  form-control" required>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>active</option>
                                <option value="99" {{ $user->status == 0 ? 'selected' : '' }}>no active</option>
                            </select>
                        </div>

                        <div class="form-group border mt-2">
                            <p><b>roles (user uchun berilgan rolelar)</b></p>
                            @if (!empty($roles))
                                @foreach ($roles as $key => $role)
                                {{-- @dd($role->permissions) --}}
                                    <label
                                        for="role_ids{{ $key }}">{{ $role->name }}({{ $role->guard_name }})</label>
                                    : <input type="checkbox" name="role_ids[]" id="role_ids{{ $key }}"
                                        value="{{ $role->id }}"
                                        @foreach ($user->user_roles as $ur)
                                        @if ($ur->id == $role->id)
                                        checked
                                        @endif @endforeach>
                                    |
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group border p-1">
                            <p><b>permissions (user uchun berilgan permissionlar)</b></p>
                            <p><i>yashil ranga bo'yalgan permissionlar ayni vaqtda userga berilgan role tarkibida mavjud yani (rolega ushbu permissionlar biriktirilib bo'lingan)</i></p>
                            @if (!empty($permissions))
                                @foreach ($permissions as $key => $permission)
                                    <label for="permission_ids{{ $permission->id }}"
                                        @foreach ($roles as $key => $role)
                                            @foreach ($role->permissions as $role_has_permission)
                                            {{-- <p>{{ $role_has_permission->pivot->permission_id }}</p> --}}
                                            @if ($role_has_permission->pivot->permission_id == $permission->id)
                                                    style="background:green;color:#fff;padding:5px;margin:5px"
                                                @endif
                                            @endforeach
                                        @endforeach
                                        >{{ $permission->name }}({{ $permission->guard_name }})</label>
                                    : <input type="checkbox" name="permission_ids[]" id="permission_ids{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        @foreach ($user->user_permissions as $up)
                                            @if ($up->id == $permission->id)
                                            checked
                                            @endif
                                        @endforeach

                                        {{-- @foreach ($roles as $key => $role)
                                        @foreach ($role->permissions as $role_has_permission)
                                            @if ($role_has_permission->id == $permission->id)
                                            checked
                                            @endif
                                        @endforeach
                                    @endforeach --}}

                                        >
                                    |
                                @endforeach
                            @endif
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
                            <input type="tel" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number, old('phone_number') }}">
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
