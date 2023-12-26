@extends('backend.layouts.main')
@section('content')
{{ app()->getLocale() }}
<h3>@lang('lang.hello')</h3>
@endsection
