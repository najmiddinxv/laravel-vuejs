@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.category') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>News</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">News</li>
      </ol>
      <div>
        <a href="{{ route('backend.news.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.tags')}}</th>
                <th>{{__('lang.main_image')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.slider')}}</th>
                <th>{{__('lang.view_count')}}</th>
                <th>{{__('lang.created_by')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $key => $newsItem)
                <tr>
                    <th scope="row">{{ $news->firstItem() + $key }}</th>
                    <td>{{ $newsItem->category?->name }}</td>

                    {{-- <td>{{ $newsItem->translate(app()->getLocale())->title }}</td> --}}
                    {{-- {{ App::setLocale('en') }}
                    <td>{{ $newsItem->title }}</td> --}}

                    {{-- yoki mana shunday qilib qo'ysak ham bo'ladi chunki mcamara yordamida avtomatik shu saytni tili bo'yicha tortayapti --}}
                    <td>{{ $newsItem->title }}</td>
                    <td>{{ $newsItem->tags()->pluck('name')->implode(', ')}}</td>
                    <td style="text-align: center">
                        @if (isset($newsItem->translate(app()->getLocale())->main_image))
                            <a href="{{ Storage::url($newsItem->translate(app()->getLocale())->main_image['large'] ?? '') }}">
                                <img src="{{ Storage::url($newsItem->translate(app()->getLocale())->main_image['medium'] ?? '') }}" alt="img" width="20%">
                            </a>
                        @else
                            <a href="{{ Storage::url($newsItem->translate('uz')->main_image['large'] ?? '') }}">
                                <img src="{{ Storage::url($newsItem->translate('uz')->main_image['medium'] ?? '') }}" alt="img" width="20%">
                            </a>
                        @endif
                    </td>
                    <td>{!! $newsItem->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{!! $newsItem->slider == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{{ $newsItem->view_count }}</td>
                    <td>{{ $newsItem->createdBy?->full_name }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.news.show',['news'=>$newsItem->id]) }}" class="btn btn-primary" title="show">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('backend.news.edit',['news'=>$newsItem->id]) }}" class="btn btn-primary" title="edit">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.news.destroy',['news'=>$newsItem->id]) }}" method="POST">
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
        {{ $news->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

    });
</script>
@endsection



