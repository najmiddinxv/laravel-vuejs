@extends('backend.layouts.index')


@section('title')
    {{__('msg.Update')}}
@endsection

@section('content')
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permissionni taxrirlash</h1>
                    </div>
                    <div class="col-sm-6">
                        {{-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}"> {{__('msg.Home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Role</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <form action="{{route('admin.permission.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nameId">Permission name</label>
                            <input type="text" name="name" id="nameId" class="form-control @error('name') error-data-input is-invalid @enderror" value="{{$model->name, old('name') }}" required>
                            <span class="error-data">@error('name'){{$message}}@enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="guard_nameId">Gurad name</label>
                            <input type="text" name="guard_name" id="guard_nameId" class="form-control @error('guard_name') error-data-input is-invalid @enderror" value="{{$model->guard_name, old('guard_name') }}" required>
                            <span class="error-data">@error('guard_name'){{$message}}@enderror</span>
                        </div>

                    <div class="card-footer">
                        <a href="{{route('admin.permission.index')}}" class="btn btn-danger">Bekor qilish</a>
                        <button type="submit" class="btn btn-success">Saqlash</button>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </form>


@endsection



