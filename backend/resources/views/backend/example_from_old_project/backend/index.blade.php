

@extends('layouts.app')

@section('content')
<h1>hello world</h1>
<a href="{{route('home.index', ['user_id' => 1, 'username' => 'john', 'limit'=>3]);}}">admin</a>

    <div class="bg-light p-5 rounded">
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <a class="btn btn-lg btn-primary" href="#" role="button">View more tutorials here &raquo;</a>
    </div>
@endsection
