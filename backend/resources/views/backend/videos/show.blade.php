@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.posts.index') }}">Post</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $post->id }}</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- @dd($post->body) --}}
        {{-- <p>
            {!! $post->body !!}
        </p> --}}

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
                    <td>{{ $post->category?->name }}</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>
                        uz - {{ $post->getTranslation('title','uz') }} <br>
                        ru - {{ $post->getTranslation('title','ru') }} <br>
                        en - {{ $post->getTranslation('title','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>
                        uz - {{ $post->getTranslation('slug','uz') }} <br>
                        ru - {{ $post->getTranslation('slug','ru') }} <br>
                        en - {{ $post->getTranslation('slug','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        uz - {{ $post->getTranslation('description','uz') }} <br>
                        ru - {{ $post->getTranslation('description','ru') }} <br>
                        en - {{ $post->getTranslation('description','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>body</td>
                    <td>
                        uz - {!! $post->getTranslation('body','uz') !!} <br>
                        ru - {!! $post->getTranslation('body','ru') !!} <br>
                        en - {!! $post->getTranslation('body','en') !!} <br>
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{!! $post->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>slider</td>
                    <td>{!! $post->slider == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>view count</td>
                    <td>{{ $post->view_count }}</td>
                </tr>
                <tr>
                    <td>created by</td>
                    <td>{{ $post->createdBy?->full_name }}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $post->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $post->updated_at }}</td>
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
