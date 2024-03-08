@extends('backend.layouts.main')
@section('title')
    {{ __('lang.create') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">role yaratish</li>
            </ol>
        </nav>
    </div>
    <form action="{{route('backend.roles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Role</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') error-data-input is-invalid @enderror" value="{{ old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard Name</label>
                            <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') error-data-input @enderror" value="{{ old('guard_name') }}" required>
                            <span class="error-data">@error('guard_name'){{$message}}@enderror</span>
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
