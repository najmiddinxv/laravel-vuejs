@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.pages.index') }}">Page</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $page->id }}</li>
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
                    <td>{{ $page->category?->name }}</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>
                        uz - {{ $page->getTranslation('title','uz') }} <br>
                        ru - {{ $page->getTranslation('title','ru') }} <br>
                        en - {{ $page->getTranslation('title','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>
                        uz - {{ $page->getTranslation('slug','uz') }} <br>
                        ru - {{ $page->getTranslation('slug','ru') }} <br>
                        en - {{ $page->getTranslation('slug','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        uz - {{ $page->getTranslation('description','uz') }} <br>
                        ru - {{ $page->getTranslation('description','ru') }} <br>
                        en - {{ $page->getTranslation('description','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>body</td>
                    <td>
                        uz - {!! $page->getTranslation('body','uz') !!} <br>
                        ru - {!! $page->getTranslation('body','ru') !!} <br>
                        en - {!! $page->getTranslation('body','en') !!} <br>
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{!! $page->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>slider</td>
                    <td>{!! $page->slider == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>view count</td>
                    <td>{{ $page->view_count }}</td>
                </tr>
                <tr>
                    <td>created by</td>
                    <td>{{ $page->createdBy?->full_name }}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $page->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $page->updated_at }}</td>
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
