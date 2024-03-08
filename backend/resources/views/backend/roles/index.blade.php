@extends('backend.layouts.main')
@section('styles')
   <style>

   </style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>Roles</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
      <div>
        <a href="{{ route('backend.roles.create') }}" class="btn btn-success">create</a>
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.Name')}}</th>
                <th>{{__('lang.Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $key => $role)
                <tr>
                    <th scope="row">{{ $roles->firstItem()+$key  }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>

                    <td>
                        <div style="text-align: center;">
                            {{-- <a href="{{ route('backend.roles.show',['id'=>$role->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a> --}}
                            <a href="{{ route('backend.roles.edit',['id'=>$role->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.roles.destroy',['id'=>$role->id]) }}" method="POST">
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
        {{ $roles->links() }}
    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


