@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.category') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Category</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
      <div>
        <a href="{{ route('backend.categories.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.parent')}}</th>
                <th>{{__('lang.category_type')}}</th>
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.icon')}}</th>
                <th>{{__('lang.image')}}</th>
                <th>{{__('lang.order')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $categories->firstItem() + $key }}</th>
                    <td>{{ $category->parent?->name }}</td>
                    <td>{{ $category->category_type }}</td>
                    <td>
                        uz - {{ $category->getTranslation('name','uz') }} <br>
                        ru - {{ $category->getTranslation('name','ru') }} <br>
                        en - {{ $category->getTranslation('name','en') }} <br>
                    </td>
                    {{-- https://github.com/mcamara/laravel-localization mana shu ishlatilgani uchun avtomat tarjima qilib yuboradi --}}
                    {{-- <td>{{ $category->name }}</td> --}}
                    {{-- <td>{{ $category->hasTranslation('name', app()->getLocale()) ? $word->getTranslation('name', app()->getLocale()) : '' }}</td> --}}
                    <td>{{ $category->icon }}</td>
                    <td style="text-align: center"><img src="{{ Storage::url($category->image['medium'] ?? '-') }}" alt="img" width="20%"></td>
                    <td>{{ $category->order }}</td>
                    <td>{!! $category->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.categories.edit',['category'=>$category->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.categories.destroy',['category'=>$category->id]) }}" method="POST">
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
        {{ $categories->links() }}
    </div>
</div>
@endsection



