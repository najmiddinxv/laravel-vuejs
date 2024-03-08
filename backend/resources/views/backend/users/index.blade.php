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
        <a href="{{ route('backend.users.create') }}" class="btn btn-success">create</a>
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">


        {{-- <x-alert-component></x-alert-component> --}}

        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('msg.Name')}}</th>
                <th>username</th>
                <th>Email</th>
                <th>avatar</th>
                <th>{{__('lang.Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{ $users->firstItem()+$key  }}</th>
                    <td>{{ $user->first_name }} {{ $user->last_name }} {{ $user->middle_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>

                    {{-- @dd($user->avatar['medium']) --}}
                    {{-- <td>{{ $user->avatar['large'] ?? '-' }}</td> --}}
                    <td style="text-align: center">
                        <a href="{{ Storage::disk('public')->url($user->avatar['large'] ?? '-') }}">
                            <img src="{{ Storage::disk('public')->url($user->avatar['medium'] ?? '-') }}" alt="">
                        </a>
                    </td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.users.show',['user'=>$user->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('backend.users.edit',['user'=>$user->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.users.destroy',['user'=>$user->id]) }}" method="POST">
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


