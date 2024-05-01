@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.pages') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Page</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Page</li>
      </ol>
      <div>
        <a href="{{ route('backend.pages.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.title')}}</th>
                <th>{{__('lang.main_image')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.slider')}}</th>
                <th>{{__('lang.view_count')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $key => $page)
                <tr>
                    <th scope="row">{{ $pages->firstItem() + $key }}</th>
                    <td>{{ $page->category?->name }}</td>
                    <td>{{ $page->title }}</td>
                    <td style="text-align: center"><a href="{{ Storage::url($page->main_image['large'] ?? '') }}"><img src="{{ Storage::url($page->main_image['medium'] ?? '') }}" alt="img" width="20%"></a></td>
                    <td>{!! $page->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{!! $page->slider == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{{ $page->view_count }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.pages.show',['page'=>$page->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('backend.pages.edit',['page'=>$page->id]) }}" class="btn btn-primary" title="edit">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.pages.destroy',['page'=>$page->id]) }}" method="POST">
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
        {{ $pages->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

    });
</script>
@endsection



