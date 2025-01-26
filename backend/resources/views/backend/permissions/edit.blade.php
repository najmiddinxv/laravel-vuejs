@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.permissions.index') }}">Permissions</a></li>
                <li class="breadcrumb-item active">{{ $permission->name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>
    <form action="{{route('backend.permissions.update',$permission->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nameId">{{__('lang.name')}}</label>
                            <input type="text" name="name" id="nameId" class="form-control @error('name') error-data-input @enderror" value="{{$permission->name, old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="guard_nameId">{{__('lang.guard name')}}</label>
                            <input type="text" name="guard_name" id="guard_nameId" class="form-control @error('guard_name') error-data-input @enderror" value="{{$permission->guard_name, old('guard_name') }}" required>
                            <span class="error-data">@error('guard_name'){{$message}}@enderror</span>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('backend.permissions.index')}}" class="btn btn-danger">{{__('lang.cancel')}}</a>
                            <button type="submit" class="btn btn-success">{{__('lang.save')}}</button>
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
