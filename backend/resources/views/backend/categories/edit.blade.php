@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item">{{ __('lang.edit') }}</li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                                value="{{ $category->getTranslation('name', 'uz'), old('name.uz') }}" required>
                            <span class="error-data">
                                @error('name.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_ru" class="form-label">Name ru</label>
                            <input type="text" name="name[ru]" id="name_ru"
                                class="form-control @error('name.ru') error-data-input @enderror" {{-- value="{{ $category->getTranslation('name', 'ru'), old('name.ru') }}" --}}
                                value="{{ $category->hasTranslation('name', 'ru') ? $category->getTranslation('name', 'ru') : '', old('name.ru') }}">
                            <span class="error-data">
                                @error('name.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_en" class="form-label">Name en</label>
                            <input type="text" name="name[en]" id="name_en"
                                class="form-control @error('name.en') error-data-input @enderror" {{-- value="{{ $category->getTranslation('name', 'en'), old('name.en') }}" --}}
                                value="{{ $category->hasTranslation('name', 'en') ? $category->getTranslation('name', 'en') : '', old('name.en') }}">
                            <span class="error-data">
                                @error('name.en')
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
                            <label for="image" class="form-label">parent</label>
                            <select class="form-select" aria-label="Default select example" name="parent_id">
                                <option value="">select parent</option>
                                @foreach ($categories as $category_item)
                                    <option value="{{ $category_item->id }}" {{ $category_item->id == $category->parent?->id ? 'selected' : '' }}>{{ $category_item->name }}</option>
                                @endforeach
                            </select>
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

                        <div class="form-group mt-3">
                            <label for="categoryable_type" class="form-label">Categoryable Type</label>
                            <select class="form-select" name="categoryable_type" id="categoryable_type">
                                {{-- <option selected="" disabled="" value="">---------</option> --}}
                                <option value="">All</option>
                                <option value="App/Models/News" {{ $category->categoryable_type == 'App/Models/News' ? 'selected' : '' }}>News</option>
                                <option value="App/Models/Post" {{ $category->categoryable_type == 'App/Models/Post' ? 'selected' : '' }}>Post</option>
                                <option value="App/Models/Image" {{ $category->categoryable_type == 'App/Models/Image' ? 'selected' : '' }}>Image</option>
                                <option value="App/Models/Page" {{ $category->categoryable_type == 'App/Models/Page' ? 'selected' : '' }}>Page</option>
                                <option value="App/Models/Video" {{ $category->categoryable_type == 'App/Models/Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            <span class="error-data">
                                @error('categoryable_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status" class="form-label">status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="">select status</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>no active</option>
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" name="order" id="order"
                                class="form-control @error('order') error-data-input @enderror"
                                value="{{ $category->order, old('order') }}" >
                            <span class="error-data">
                                @error('order')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="icon" class="form-label">icon</label>
                            <input type="text" name="icon" id="icon"
                                class="form-control @error('icon') error-data-input @enderror"
                                value="{{ $category->icon, old('icon') }}" >
                            <span class="error-data">
                                @error('icon')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mt-3">
                            <label for="image" class="form-label">image</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') error-data-input @enderror">
                            <img id="previewImage" src="{{ Storage::url($category->image['large'] ?? '-') }}" alt="Img" style="max-width: 100%;">

                            <span class="error-data">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
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
            $('#image').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewImage').css({'display':'block'});
                }
                reader.readAsDataURL(this.files[0]);

            });
        });
    </script>
@endsection
