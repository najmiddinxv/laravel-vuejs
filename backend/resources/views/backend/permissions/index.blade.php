@extends('backend.layouts.main')
@section('styles')
   <style>

   </style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Permission</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Permission</li>
      </ol>
      <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-permission">Create</button>
        {{-- <a href="{{ route('backend.roles.create') }}" class="btn btn-success">create</a> --}}
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $key => $permission)
                <tr>
                    <th scope="row">{{ $permissions->firstItem()+$key  }}</th>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.permissions.edit',['id'=>$permission->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.permissions.destroy',['id'=>$permission->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-data-item btn btn-danger" title="delete">
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $permissions->links() }}
    </div>
</div>

<div class="modal fade" id="create-permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="create-permission-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('backend.permissions.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-permission-label">Permission yaratish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-label">Permission</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                <span class="error-data">@error('name'){{$message}}@enderror</span>
                            </div>

                            <div class="form-group mt-10">
                                <label for="guard_name" class="form-label">Guard Name</label>
                                <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') error-data-input @enderror" value="{{ old('guard_name') }}" required>
                                <span class="error-data">@error('guard_name'){{$message}}@enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('lang.close')}}</button>
                    <button type="submit" class="btn btn-success">{{__('lang.save')}}</button>
                </div>
            </div>
        </form>
    </div>
  </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


