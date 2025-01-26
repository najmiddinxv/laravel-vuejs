@extends('frontend.layouts.main')
@section('content')

    <div class="container">
        <h3>@lang('lang.hello') " {{ auth()->user()->full_name }} " User profile sahifasiga xush kelibsiz</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut nesciunt voluptatum ipsum laborum quam ullam culpa esse reprehenderit, aspernatur dolores laboriosam dolor. Nam cumque quaerat nobis? Dolorum omnis voluptatem corrupti!</p>

    </div>

{{-- <x-footer-component></x-footer-component> --}}
@endsection
