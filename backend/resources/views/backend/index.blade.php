@extends('backend.layouts.main')
@section('content')
    {{ app()->getLocale() }}
    <h3>@lang('lang.hello')</h3>

    <hr>
        <p>role</p>
        {{-- @role('super-admin', 'admin')
            I am a super-admin!
        @else
            I am not a super-admin...
        @endrole --}}
        @role('admin')
            <h1>men Admin</h1>
        @else
            <h1>Admin emasman</h1>
        @endrole

        @role('manager')
            <h1>men manager</h1>
        @else
            <h1>manager emasman</h1>
        @endrole

        @role('user')
            <h1>men user</h1>
        @else
            <h1>user emasman</h1>
        @endrole

        <p>permission</p>
        @can('delete')
            <h1>delete</h1>
        @else
            <h1>delete qilish imkoniyatim yoq</h1>
        @endcan

        @can('publish')
            <h1>publish</h1>
        @else
            <h1>publish qilish imkoniyatim yoq</h1>
        @endcan

        @can('view')
            <h1>view</h1>
        @else
            <h1>view qilish imkoniyatim yoq</h1>
        @endcan

        {{-- @if(auth()->user()->can('edit articles') && $some_other_condition)

        @endif --}}
@endsection
