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
                <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name_uz" class="form-label">Name uz</label>
                            <input type="text" name="name[uz]" id="name_uz"
                                class="form-control @error('name.uz') error-data-input @enderror"
                                value="{{ old('name.uz') }}" required>
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
                                value="{{ old('name.ru') }}">
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
                                value="{{ old('name.en') }}">
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
                                    <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="categoryable_type" class="form-label">Categoryable Type</label>
                            <select class="form-select" name="categoryable_type" id="categoryable_type">
                                {{-- <option selected="" disabled="" value="">---------</option> --}}
                                <option value="">All</option>
                                <option value="App\Models\Content\News">News</option>
                                <option value="App\Models\Content\Post">Post</option>
                                <option value="App\Models\Content\Image">Image</option>
                                <option value="App\Models\Content\Page">Page</option>
                                <option value="App\Models\Content\Video">Video</option>
                            </select>
                            <span class="error-data">
                                @error('categoryable_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mt-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" name="order" id="order"
                                class="form-control @error('order') error-data-input @enderror"
                                value="{{ old('order') }}" >
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
                                value="{{ old('icon') }}" >
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
                            <img id="previewImage" src="" alt="Img" style="max-width: 100%;">

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
