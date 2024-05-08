@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.news.index') }}">News</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $news->id }}</li>
            </ol>
        </nav>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Column name</th>
                    <th>data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>category</td>
                    <td>{{ $news->category?->name }}</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>
                        <b>uz</b> - {{ $news->translate(app()->getLocale())->title }} <br>
                        <b>ru</b> - {{ $news->translate(app()->getLocale())->title }} <br>
                        <b>en</b> - {{ $news->translate(app()->getLocale())->title }} <br>
                    </td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>
                        <b>uz</b> - {{ $news->slug }} <br>
                        <b>ru</b> - {{ $news->slug }} <br>
                        <b>en</b> - {{ $news->slug }} <br>
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        <b>uz</b> - {{ $news->description }} <br>
                        <b>ru</b> - {{ $news->description }} <br>
                        <b>en</b> - {{ $news->description }} <br>
                    </td>
                </tr>
                <tr>
                    <td>body</td>
                    <td>
                        <b>uz</b> - {!! $news->body !!} <br>
                        <b>ru</b> - {!! $news->body !!} <br>
                        <b>en</b> - {!! $news->body !!} <br>
                    </td>
                </tr>
                <tr>
                    <td>image</td>
                    <td><a href="{{ Storage::url($news->main_image['large'] ?? '') }}"><img src="{{ Storage::url($news->main_image['medium'] ?? '') }}" alt="img" width="20%"></a></td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{!! $news->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>slider</td>
                    <td>{!! $news->slider == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>view count</td>
                    <td>{{ $news->view_count }}</td>
                </tr>
                <tr>
                    <td>created by</td>
                    <td>{{ $news->createdBy?->full_name }}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $news->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $news->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {

        });
    </script>
@endsection
