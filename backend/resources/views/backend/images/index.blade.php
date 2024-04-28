@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.images') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Images</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Images</li>
      </ol>
      <div>
        <a href="{{ route('backend.images.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.category')}}</th>
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.path')}}</th>
                <th>{{__('lang.mime_type')}}</th>
                <th>{{__('lang.size')}}</th>
                <th>{{__('lang.uploaded_by')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $key => $image)
                <tr>
                    <th scope="row">{{ $images->firstItem() + $key }}</th>
                    <td>{{ $image->category?->name }}</td>
                    <td>{{ $image->name }}</td>
                    <td style="text-align: center">
                        <a href="{{ Storage::url($image->path['large'] ?? '-') }}">
                            <img src="{{ Storage::url($image->path['medium'] ?? '-') }}" alt="" style="width:30%">
                        </a>
                    </td>
                    <td>{{ $image->mime_type }}</td>
                    <td>{{ Number::fileSize($image->size); }}</td>
                    <td>{{ $image->uploadedBy?->full_name }}</td>
                    <td>{!! $image->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>
                        <div style="text-align: center;">

                            <a href="{{ route('backend.images.edit',['image'=>$image->id]) }}" class="btn btn-primary" title="edit">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.images.destroy',['image'=>$image->id]) }}" method="POST">
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
        {{ $images->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

    });
</script>
@endsection



