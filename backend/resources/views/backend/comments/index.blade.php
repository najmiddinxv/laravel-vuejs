@extends('backend.layouts.main')
@section('content')
<div class="pagetitle">
    <h1>Tags</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tags</li>
      </ol>
      <div>
        {{-- <a href="{{ route('backend.roles.create') }}" class="btn btn-success">create</a> --}}
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">
          <x-alert-message-component></x-alert-message-component>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('lang.commentable_type')}}</th>
                <th>{{__('lang.commentable_id')}}</th>
                <th>{{__('lang.parent_id')}}</th>
                <th>{{__('lang.user_id')}}</th>
                <th>{{__('lang.body')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $key => $comment)
                <tr>
                    <th scope="row">{{ $comments->firstItem() + $key }}</th>
                    <td>{{ $comment->commentable_type }}</td>
                    <td>{{ $comment->commentable_id }}</td>
                    <td>{{ $comment->parent?->body }}</td>
                    <td>{{ $comment->user->full_name }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.comments.show',['comment'=>$comment->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-show"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.comments.destroy',['comment'=>$comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-data-item btn btn-danger" title="delete">
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $comments->links() }}
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


