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




                        <div>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-uz-tab" data-bs-toggle="pill" data-bs-target="#pills-uz" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Uz</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-ru-tab" data-bs-toggle="pill" data-bs-target="#pills-ru" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Ру</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-en-tab" data-bs-toggle="pill" data-bs-target="#pills-en" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" tabindex="-1">En</button>
                                </li>
                              </ul>
                              <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade active show" id="pills-uz" role="tabpanel" aria-labelledby="uz-tab">
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
                                        <label for="description_uz" class="form-label">Description uz</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[uz]" id="description_uz"  style="height: 130px;" >{{ old('description.uz') }}</textarea>
                                        <span class="error-data">
                                            @error('description.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-ru" role="tabpanel" aria-labelledby="ru-tab">
                                    <div class="form-group">
                                        <label for="name_ru" class="form-label">Name ru</label>
                                        <input type="text" name="name[ru]" id="name_ru"
                                            class="form-control @error('name.ru') error-data-input @enderror"
                                            value="{{ old('name.ru') }}">
                                        <span class="error-data">
                                            @error('name.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_ru" class="form-label">Description ru</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[ru]" id="description_ru" style="height: 130px;" >{{ old('description.ru') }}</textarea>
                                        <span class="error-data">
                                            @error('description.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group">
                                        <label for="name_en" class="form-label">Name en</label>
                                        <input type="text" name="name[en]" id="name_en"
                                            class="form-control @error('name.en') error-data-input @enderror"
                                            value="{{ old('name.en') }}">
                                        <span class="error-data">
                                            @error('name.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_en" class="form-label">Description en</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[en]" id="description_en" style="height: 130px;" >{{ old('description.en') }}</textarea>
                                        <span class="error-data">
                                            @error('description.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                              </div>
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
                                @foreach ($categories as $category_item)
                                    <option value="">select category</option>
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
