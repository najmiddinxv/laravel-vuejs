@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">{{ $role->name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>
    <form action="{{route('backend.roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Role name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') error-data-input is-invalid @enderror" value="{{$role->name, old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard name</label>
                            <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') error-data-input is-invalid @enderror" value="{{$role->guard_name, old('guard_name') }}" required>
                            <span class="error-data">@error('guard_name'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <p><b>permissions (role uchun berilgan permissionlar)</b></p>
                            <p>Yuqoridagi Guard name ga qarab chiqadi web yoki api</p>
                            @if(!empty($permissions))
                                @foreach($permissions as $key => $permission)
                                    @if($role->guard_name == $permission->guard_name)
                                        <label for="permission_id{{ $key }}">{{$permission->name}}({{$permission->guard_name}})</label> : <input type="checkbox" name="permission_id[]" id="permission_id{{ $key }}" value="{{$permission->id}}"

                                    @foreach($role->permissions as $mp)
                                        @if($mp->id == $permission->id)
                                        checked
                                        @endif
                                    @endforeach
                                    >|
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <div class="card-footer">
                            <a href="{{route('backend.roles.index')}}" class="btn btn-danger">Bekor qilish</a>
                            <button type="submit" class="btn btn-success">Saqlash</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
@section('scripts')
<script>
    $(document).ready(function (e) {

    });
</script>
@endsection
