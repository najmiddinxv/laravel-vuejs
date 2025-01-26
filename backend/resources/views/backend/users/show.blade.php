@extends('backend.layouts.main')
@section('styles')
   <style>

   </style>
@endsection
@section('content')
<div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">{{ $user->username }}</li>
      </ol>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">

        <p>{{ $user->username }}</p>
        <p>{{ $user->email }}</p>

    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


