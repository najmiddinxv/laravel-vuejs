@extends('frontend.layouts.main')
@section('content')
<x-header-component></x-header-component>

    <div class="container">
        <div>
            <form action="{{route('userProfile.auth.logout')}}" method="POST">
                @csrf
                @method('POST')
                <button class="dropdown-item d-flex align-items-center" >
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>


        <h3>@lang('lang.hello') User profile sahifasiga xush kelibsiz</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut nesciunt voluptatum ipsum laborum quam ullam culpa esse reprehenderit, aspernatur dolores laboriosam dolor. Nam cumque quaerat nobis? Dolorum omnis voluptatem corrupti!</p>
    </div>

{{-- <x-footer-component></x-footer-component> --}}
@endsection
