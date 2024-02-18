@extends('backend.layouts.index')

@section('head')
    <link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="ibox-content">
        <div class="form-group">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{ route('admin.user.update', ['uuid' => $user->uuid]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    {{-- <label for="first_name">first_name</label> --}}
                    <div class="form-group">
                        <input type="text" name="first_name" id="first_name"
                            class="form-control @error('first_name') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Familya') }}" value="{{ $user->first_name, old('first_name') }}">
                        <span class="error-data">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    {{-- <label for="last_name">last_name</label> --}}
                    <div class="form-group">
                        <input type="text" name="last_name" id="last_name"
                            class="form-control @error('last_name') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Ism') }}" value="{{ $user->last_name, old('last_name') }}">
                        <span class="error-data">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    {{-- <label for="middle_name">middle_name</label> --}}
                    <div class="form-group">
                        <input type="text" name="middle_name" id="middle_name"
                            class="form-control @error('middle_name') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Sharif') }}"
                            value="{{ $user->middle_name, old('middle_name') }}">
                        <span class="error-data">
                            @error('middle_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- <label for="phone_number">phone_number</label> --}}
                    <div class="form-group">
                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Telefon Raqam') }}" value="{{ $user->phone, old('phone') }}">
                        <span class="error-data">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="form-group">
                        <input type="text" name="email" id="email"
                            class="form-control @error('email') error-data-input is-invalid @enderror" placeholder="Email"
                            value="{{ $user->email, old('email') }}">
                        <span class="error-data">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="form-group">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Parol') }}" value="{{ $user->password, old('password') }}">
                        <span class="error-data">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="border border-danger p-2 mb-2">

                        <div class="form-group">
                            <select name="user_type" id="user_type" class="user_type  form-control" required>
                                <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }}>Admin (Backend qismiga ruxsat)</option>
                                <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>User (Faqat Frontend qismiga ruxsat)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="is_active" id="is_active" class="select2_is_active  form-control" required>
                                <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>active</option>
                                <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>parolini qayta o'rnatishi
                                    kerak</option>
                                <option value="99" {{ $user->is_active == 99 ? 'selected' : '' }}>no active</option>
                            </select>
                        </div>

                        <div class="form-group border p-1">
                            <p><b>permissions (user uchun berilgan permissionlar)</b></p>
                            @if(!empty($permissions))
                                @foreach($permissions as $key => $permission)
                                    <label for="permission_ids{{ $key }}">{{$permission->name}}({{$permission->guard_name}})</label> : <input type="checkbox" name="permission_ids[]" id="permission_ids{{ $key }}" value="{{$permission->id}}"
                                    @foreach($user->user_permissions as $up)
                                        @if($up->id == $permission->id)
                                        checked
                                        @endif
                                    @endforeach
                                    > |
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group border p-1">
                            <p><b>roles (user uchun berilgan rolelar)</b></p>
                            @if(!empty($roles))
                                @foreach($roles as $key => $role)
                                    <label for="role_ids{{ $key }}">{{$role->name}}({{$role->guard_name}})</label> : <input type="checkbox" name="role_ids[]" id="role_ids{{ $key }}" value="{{$role->id}}"
                                    @foreach($user->user_roles as $ur)
                                        @if($ur->id == $role->id)
                                        checked
                                        @endif
                                    @endforeach
                                    > |
                                @endforeach
                            @endif
                        </div>
                    </div>


                    <button class="btn btn-primary" type="submit">Сақлаш</button>

                </div>
                <div class="col-lg-4">
                    {{-- <div class="form-group">
                        <label for="avatar">{{to_cyrillic('Avatar')}}</label>
                        <input type="file" name="avatar" id="avatar"
                            class="form-control @error('avatar') error-data-input is-invalid @enderror"
                            placeholder="{{to_cyrillic('Avatar')}}" value="{{ old('avatar') }}">
                        <span class="error-data">
                            @error('avatar')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <label for="file">{{to_cyrillic('Fayl')}}</label>
                    <div class="form-group">
                        <input type="file" name="file" id="file"
                            class="form-control @error('file') error-data-input is-invalid @enderror"
                            placeholder="{{to_cyrillic('Fayl')}}" value="{{ old('file') }}">
                        <span class="error-data">
                            @error('file')
                                {{ $message }}
                            @enderror
                        </span>
                    </div> --}}
                    <div class="form-group">
                        <select name="bank_branch_id" id="bank_branch_id" class="select2_bank_branch_id  form-control"
                            required>
                            @empty(!$bank_branches)
                                @foreach ($bank_branches as $bank_branch)
                                    <option value="{{ $bank_branch->id }}"
                                        {{ $bank_branch->id == $user->bank_branch_id ? 'selected' : '' }}>
                                        {{ $bank_branch->name }}</option>
                                @endforeach
                            @endempty
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="position" id="position" class="position  form-control" required>
                            @empty(!$positions)
                                <option value="">--------------------------------
                                </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ $position->id == $user->position ? 'selected' : '' }}>
                                        {{ $position->name }}</option>
                                @endforeach
                            @endempty
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="role_id" id="role_id" class="select2_role_id  form-control" required>
                            @empty(!$roles)
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            @endempty
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="sex" id="sex" class="sex  form-control" required>
                            <option value="0" {{ $user->sex == 0 ? 'selected' : '' }}>Эркак</option>
                            <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>Аёл</option>
                        </select>
                    </div>


                    <label for="birth_date">Йил-ой-кун</label>
                    <div class="form-group">
                        <input type="text" name="birth_date" id="birth_date"
                            class="birth_date form-control @error('birth_date') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Туғилган йили*') }}"
                            value="{{ $user->birth_date, old('birth_date') }}">
                        <span class="error-data">
                            @error('birth_date')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    @if (!empty($user->file))
                        <div class="form-control">
                            <a href="{{ asset("storage/user/{$user->id}/$user->file") }}"
                                class="link">{{ $user->file }}</a>
                            <span>
                                <- Бу эски файл агар ҳозир файл юкласангиз эски файл ўчирилиб жойига ҳозир юклаган файлингиз
                                    ёзилади</span>
                        </div>
                    @endif

                    <label for="file">{{ to_cyrillic('Fayl') }}</label>
                    <div class="form-group">
                        <input type="file" name="file" id="file"
                            class="form-control @error('file') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Fayl') }}" accept=".pdf, .doc, .docx">
                        <span class="error-data">
                            @error('file')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    @if (!empty($user->avatar))
                        <div class="form-control">
                            <a href="{{ asset("storage/user/{$user->id}/l_$user->avatar") }}"
                                class="link">{{ $user->avatar }}</a>
                            <span>
                                <- Бу эски файл агар Ҳозир файл юкласангиз эски файл ўчирилиб жойига Ҳозир юклаган
                                    файлингизёзилади</span>
                        </div>
                    @endif

                    <label for="file">{{ to_cyrillic('Avatar') }}</label>
                    <div class="form-group">
                        <input type="file" name="avatar" id="avatar"
                            class="form-control @error('avatar') error-data-input is-invalid @enderror"
                            placeholder="{{ to_cyrillic('Fayl') }}" accept=".png, .jpg, .jpeg">
                        <span class="error-data">
                            @error('avatar')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>




                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jqueryMask/jquery.mask.min.js') }}"></script>

    <script>
        $("#user_type").select2({
            // theme: 'bootstrap4',
            // placeholder: "Select a state",
            // allowClear: true
        });
        $("#is_active").select2({
            // theme: 'bootstrap4',
            // placeholder: "Select a state",
            // allowClear: true
        });
        $("#bank_branch_id").select2({
            // theme: 'bootstrap4',
            // placeholder: "Select a state",
            // allowClear: true
        });

        $("#position").select2({
            // theme: 'bootstrap4',
            // placeholder: "Select a state",
            // allowClear: true
        });

        $('.birth_date').inputmask({
            mask: '9999-99-99'
        });
    </script>
@endsection
