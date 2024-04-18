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
                <li class="breadcrumb-item active">{{ $category->name }}</li>
                <li class="breadcrumb-item active">{{ __('lang.edit') }}</li>
            </ol>
        </nav>
    </div>
    <form action="{{ route('backend.words.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group mt-3">
                            <label for="image" class="form-label">parent</label>
                            <select class="form-select" aria-label="Default select example" name="parent_id">
                                <option value="">select parent</option>
                                <option value="0">no active</option>
                                <option value="1">active</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="image" class="form-label">category type</label>
                            <select class="form-select" aria-label="Default select example" name="parent_id">
                                <option value="">select parent</option>
                                <option value="0">no active</option>
                                <option value="1">active</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="status" class="form-label">status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="">select status</option>
                                <option value="0">no active</option>
                                <option value="1">active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="text" name="order" id="order"
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

        });
    </script>
@endsection
