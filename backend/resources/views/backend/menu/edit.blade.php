@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.menu.index') }}">Menu</a></li>
                <li class="breadcrumb-item">{{ __('lang.edit') }}</li>
                <li class="breadcrumb-item active">{{ $menu->name }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name_uz" class="form-label">Name uz</label>
                            <input type="text" name="name[uz]" id="name_uz"
                                class="form-control @error('name.uz') error-data-input @enderror"
                                value="{{ $menu->getTranslation('name', 'uz'), old('name.uz') }}" required>
                            <span class="error-data">
                                @error('name.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_ru" class="form-label">Name ru</label>
                            <input type="text" name="name[ru]" id="name_ru"
                                class="form-control @error('name.ru') error-data-input @enderror"
                                value="{{ $menu->hasTranslation('name', 'ru') ? $menu->getTranslation('name', 'ru') : '', old('name.ru') }}">
                            <span class="error-data">
                                @error('name.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_en" class="form-label">Name en</label>
                            <input type="text" name="name[en]" id="name_en"
                                class="form-control @error('name.en') error-data-input @enderror"
                                value="{{ $menu->hasTranslation('name', 'en') ? $menu->getTranslation('name', 'en') : '', old('name.en') }}">
                            <span class="error-data">
                                @error('name.en')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mt-3">
                            <label for="url_uz" class="form-label">Url(uz)</label>
                            <input type="text" name="url[uz]" id="url_uz"
                                class="form-control @error('url.uz') error-data-input @enderror"
                                value="{{ $menu->getTranslation('url', 'uz'), old('url.uz') }}" required>
                            <span class="error-data">
                                @error('url.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="url_ru" class="form-label">Url(ru)</label>
                            <input type="text" name="url[ru]" id="url_ru"
                                class="form-control @error('url.ru') error-data-input @enderror"
                                value="{{ $menu->hasTranslation('url', 'ru') ? $menu->getTranslation('url', 'ru') : '', old('url.ru') }}">
                            <span class="error-data">
                                @error('url.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="url_en" class="form-label">Url(en)</label>
                            <input type="text" name="url[en]" id="url_en"
                                class="form-control @error('url.en') error-data-input @enderror"
                                value="{{ $menu->hasTranslation('url', 'en') ? $menu->getTranslation('url', 'en') : '', old('url.en') }}">
                            <span class="error-data">
                                @error('url.en')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">


                        <div class="form-group mt-1">
                            <label for="position" class="form-label">Position</label>
                            <select name="position" id="position" class="form-select" aria-label="Default select example" required>
                                <option value="1" {{ $menu->position == 1 ? 'selected' : '' }}>Header menu</option>
                                <option value="2" {{ $menu->position == 2 ? 'selected' : '' }}>Footer menu</option>
                                <option value="3" {{ $menu->position == 3 ? 'selected' : '' }}>Sidebar menu</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image" class="form-label">Parent</label>
                            <select class="form-select" aria-label="Default select example" name="parent_id">
                                <option value="">Select parent</option>
                                @foreach ($allMenu as $menuItem)
                                    @if ($menuItem->position == 1)
                                        <optgroup label="Header menu">
                                            <option value="{{ $menuItem->id }}" {{ $menuItem->id == $menu->parent?->id ? 'selected' : '' }}>{{ $menuItem->name }}</option>
                                        </optgroup>
                                    @elseif($menuItem->position == 2)
                                        <optgroup label="Footer menu">
                                            <option value="{{ $menuItem->id }}" {{ $menuItem->id == $menu->parent?->id ? 'selected' : '' }}>{{ $menuItem->name }}</option>
                                        </optgroup>
                                    @elseif($menuItem->position == 3)
                                        <optgroup label="Sidebar menu">
                                            <option value="{{ $menuItem->id }}" {{ $menuItem->id == $menu->parent?->id ? 'selected' : '' }}>{{ $menuItem->name }}</option>
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>active</option>
                                <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>no active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="menu_order" class="form-label">Order</label>
                            <input type="number" name="menu_order" id="menu_order"
                                class="form-control @error('menu_order') error-data-input @enderror"
                                value="{{ $menu->menu_order , old('menu_order') }}" >
                            <span class="error-data">
                                @error('menu_order')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        {{-- <ul>
                            @foreach($menus as $menu)
                                <li>
                                    <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                                    @if($menu->children->isNotEmpty())
                                        <ul>
                                            @foreach($menu->children as $childMenu)
                                                <li><a href="{{ $childMenu->url }}">{{ $childMenu->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul> --}}


                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {

        });
    </script>
@endsection
