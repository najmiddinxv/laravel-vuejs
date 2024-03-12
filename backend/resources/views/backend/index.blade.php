@extends('backend.layouts.main')
@section('content')
    {{ app()->getLocale() }}
    <h3>@lang('lang.hello')</h3>

    @can('create')
        <p>create</p>
    @endcan
    <hr>
        <h3>roles - Rollar</h3>
        {{-- @role('super-admin', 'admin')
            I am a super-admin!
        @else
            I am not a super-admin...
        @endrole --}}
        @role('admin')
            <p>men Admin</p>
        @else
            <p>Admin emasman</p>
        @endrole

        @role('manager')
            <p>men manager</p>
        @else
            <p>manager emasman</p>
        @endrole

        @role('user')
            <p>men user</p>
        @else
            <p>user emasman</p>
        @endrole

        <h3>permissions - ruxsatlar</h3>
        @can('delete')
            <p>delete qilaolaman</p>
        @else
            <h1>delete qilish imkoniyatim yoq</h1>
        @endcan

        @can('publish')
            <p>publish qilaolaman</p>
        @else
            <h1>publish qilish imkoniyatim yoq</h1>
        @endcan

        @can('view')
            <p>view qilaolaman</p>
        @else
            <p>view qilish imkoniyatim yoq</p>
        @endcan

        @can('publish')
            <p>publish qilaolaman</p>
        @else
            <p>publish qilish imkoniyatim yoq</p>
        @endcan

        @can('modify')
            <p>modify qilaolaman</p>
        @else
            <p>modify qilish imkoniyatim yoq</p>
        @endcan

        {{-- @if(auth()->user()->can('edit articles') && $some_other_condition)

        @endif --}}
@endsection
