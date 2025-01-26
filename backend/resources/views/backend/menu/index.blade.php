@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.menu') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Menu</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>
      <div>
        <a href="{{ route('backend.menu.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.url')}}</th>
                <th>{{__('lang.position')}}</th>
                <th>{{__('lang.order')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menu as $key => $menuItem)
                <tr>
                    <th scope="row">{{ $menu->firstItem() + $key }}</th>
                    <td>{{ $menuItem->parent?->name }}</td>
                    <td>
                        uz - {{ $menuItem->getTranslation('name','uz') }} <br>
                        ru - {{ $menuItem->getTranslation('name','ru') }} <br>
                        en - {{ $menuItem->getTranslation('name','en') }} <br>
                    </td>
                    <td>
                        uz - {{ $menuItem->getTranslation('url','uz') }} <br>
                        ru - {{ $menuItem->getTranslation('url','ru') }} <br>
                        en - {{ $menuItem->getTranslation('url','en') }} <br>
                    </td>
                    <td>{{ $menuItem->position }}</td>
                    <td>{{ $menuItem->menu_order }}</td>
                    <td>{!! $menuItem->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.menu.edit',['menu'=>$menuItem->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.menu.destroy',['menu'=>$menuItem->id]) }}" method="POST">
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
        {{ $menu->links() }}
    </div>
</div>
@endsection
