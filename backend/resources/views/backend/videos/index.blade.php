@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.category') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Videos</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Videos</li>
      </ol>
      <div>
        <a href="{{ route('backend.videos.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">
          <x-alert-message-component></x-alert-message-component>
        <table class="table-responsive table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('lang.category')}}</th>
                <th>{{__('lang.title')}}</th>
                <th>{{__('lang.description')}}</th>
                <th>{{__('lang.thumbanil')}}</th>
                <th>{{__('lang.mime_type')}}</th>
                <th>{{__('lang.size')}}</th>
                <th>{{__('lang.download_count')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.uploaded_by')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($videos as $key => $video)
                <tr>
                    <th scope="row">{{ $videos->firstItem() + $key }}</th>
                    <td>{{ $video->category?->name }}</td>
                    <td>{{ $video->name }}</td>
                    <td>{{ $video->description }}</td>
                    <td style="text-align: center">
                        <a href="{{ Storage::url($video->thumbnail['large'] ?? '') }}">
                            <img src="{{ Storage::url($video->thumbnail['medium'] ?? '') }}" alt="img" width="20%">
                        </a>
                    </td>
                    <td>{{ $video->mime_type }}</td>
                    <td>{{ Number::fileSize($video->size); }}</td>
                    <td>{{ $video->download_count }}</td>
                    <td>{!! $video->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{{ $video->uploaded_by }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.videos.show',['video'=>$video->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('backend.videos.edit',['video'=>$video->id]) }}" class="btn btn-primary" title="edit">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.videos.destroy',['video'=>$video->id]) }}" method="POST">
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
        {{ $videos->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

    });
</script>
@endsection



