@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.comments.index') }}">Comment</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $comment->id }}</li>
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
                    <td>commentable_type</td>
                    <td>{{ $comment->commentable_type }}</td>
                </tr>
                <tr>
                    <td>commentable_id</td>
                    <td>{{ $comment->commentable_id }}</td>
                </tr>

                <tr>
                    <td>user</td>
                    <td>{{ $comment->user?->full_name }}</td>
                </tr>
                <tr>
                    <td>parent</td>
                    <td>{{ $comment->parent?->body }}</td>
                </tr>
                <tr>
                    <td>body</td>
                    <td>{{ $comment->body }}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $comment->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $comment->updated_at }}</td>
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
