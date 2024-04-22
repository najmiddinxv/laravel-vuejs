@extends('layouts.backend')
@section('content')
<div class="container">
    <p>show page</p>
   <h1>{{$post->title}}</h1>
   <h1>{{$post->description}}</h1>
</div>
@endsection
