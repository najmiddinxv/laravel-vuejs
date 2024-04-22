@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.tinymceFiles.index') }}">Files</a></li>
                <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.tinymceFiles.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                                <option value="">select category</option>
                                @foreach ($categories as $category_item)
                                    <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="file" class="form-label">image</label>
                            <input type="file" name="file" id="file"
                                class="form-control @error('file') error-data-input @enderror">
                            <span class="error-data">
                                @error('file')
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
