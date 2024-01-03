@extends('backend.layouts.main')
@section('styles')
   <style>

   </style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>User</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">User</li>
      </ol>
      <div>
        <a href="{{ route('backend.user.create') }}" class="btn btn-success">create</a>
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}


        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.Name')}}</th>
                <th>Email</th>
                <th>{{__('lang.Created date')}}</th>
                <th>{{__('lang.Updated date')}}</th>
                <th>{{__('lang.Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{ $users->firstItem()+$key  }}</th>
                    <td>{{ $user->firs_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <div style="text-align: center;">

                            <a href="{{ route('backend.user.show',['user'=>$user->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('backend.user.edit',['user'=>$user->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.user.destroy',['user'=>$user->id]) }}" method="POST">
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
        {{ $users->links() }}
    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


